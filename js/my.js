/**
 * Created by Administrator on 2015/11/13.
 */
angular.module('myApp', [ 'ng','ngRoute','ngAnimate' ])
  .controller('startCtrl',function($scope,$rootScope,$location){
    $rootScope.jump=function(p){
      //实现页面跳转
      console.log(p);
      $location.path(p);
    }
  })
  .controller('mainCtrl',function($scope,$http){
    $scope.isLoading=true;//是否正在加载
    $scope.hasMore=true;  //还有更多数据可以加载吗
    $http.get('data/dish_listbypage.php').success(function(data){
      //console.log(data);
      $scope.dishList=data;
      $scope.isLoading=false;
    })
    $scope.loadMore=function(){
      $scope.isLoading=true;
      $http.get('data/dish_listbypage.php?start='+$scope.dishList.length).success(function(data){
        $scope.dishList=$scope.dishList.concat(data);
        $scope.isLoading=false;
        if(data.length<5){
          $scope.hasMore=false;
        }
      })
    }
    //监视模型变量kw的修改
    $scope.$watch('kw',function(){
      if($scope.kw.trim().length===0||$scope.kw===undefined){
        return;
      }
      $scope.isLoading=true;
      $http.get('data/dish_querybykw.php?kw='+$scope.kw).success(function(data){
        $scope.dishList=data;
        //console.log(data);
        $scope.isLoading=false;
      })
    })
  })
  .controller('detailCtrl',function($scope,$routeParams,$http){
    //console.log($routeParams);
    $http.get('data/dish_querybyid.php?did='+$routeParams.did).success(function(data){
      $scope.dish=data;
      console.log($scope.dish);
    })
  })
  .controller('orderCtrl',function($scope,$routeParams,$http,$rootScope){
    //console.log($routeParams);
    $scope.isSubmited=false;
    $scope.user_name='婷婷';
    $scope.phone='13501234567';
    $scope.sex='2';
    $scope.addr='万寿路西街2号';
    $scope.submitOrder=function(){
      $http.post(
        'data/order_add.php',
        $.param($scope.formData),
        {headers:{'Content-Type':'application/x-www-form-urlencoded'}}
      ).success(function(data){
          if(data.result==200){
            $scope.succMsg = '订餐成功！您的订单编号为：'+data.oid+'。您可以在用户中心查看订单状态。'
            $rootScope.phone = $scope.formData.phone;
          }else {
            $scope.errMsg = '订餐失败！错误码为：'+data.result;
          }
        });
    }
  })
  .controller('myordersCtrl',function($scope){
    $http.get('data/order_querybyphone.php?phone='+$rootScope.phone).success(function(data){
      $scope.orderList = data;
    });
  })
  .config(function($routeProvider){  //配置路由字典的映射关系
    $routeProvider
      .when('/start', {
        templateUrl: 'tpl/start.html',
        controller:'startCtrl'
      })
      .when('/main', {
        templateUrl: 'tpl/main.html',
        controller:'mainCtrl'
      })
      .when('/detail/:did', {
        templateUrl: 'tpl/detail.html',
        controller:'detailCtrl'
      })
      .when('/order/:did', {
        templateUrl: 'tpl/order.html',
        controller:'orderCtrl'
      })
      .when('/myorders', {
        templateUrl: 'tpl/myorders.html'
      })
      .otherwise({//若地址未提供或者提供了错误的路由地址
        redirectTo:'/start'
      })
  })


