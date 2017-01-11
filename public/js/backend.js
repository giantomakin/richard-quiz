(function() {
  var app;

  app = angular.module('backendApp', ['ngRoute']);

  app.controller('backendCtrl', function($scope, $element, $http) {
    var question_id;
    question_id = void 0;
    $scope.count = 1;
    question_id = $element.find('#question_id').val();
    $http({
      method: 'GET',
      url: '/quiz/api/' + question_id,
      headers: {
        'Content-type': 'application/json'
      }
    }).then((function(response) {
      var jsonData;
      jsonData = void 0;
      $scope.quiz = response.data;
      if ($scope.quiz.data !== '') {
        jsonData = JSON.parse($scope.quiz.data);
        if ($scope.quiz.data_img !== '') {
          $scope.imgs = JSON.parse($scope.quiz.data_img);
        } else {
          $scope.imgs = '';
        }
        if ($scope.quiz.results !== '') {
          $scope.results = JSON.parse($scope.quiz.results);
        } else {
          $scope.results = '';
        }
        if (Object.prototype.toString.call(jsonData) === '[object Array]') {
          return $scope.items = jsonData;
        } else {
          return $scope.items = $.map(jsonData, function(el) {
            return el;
          });
        }
      } else {
        return $scope.items = [];
      }
    }), function(response) {
      throw new Error(response.responseText);
    });
    $scope.removeAnswer = function(array, index) {
      return array.splice(index, 1);
    };
    return $scope.addAnswer = function(data) {
      $scope.count++;
      return $scope.items.push({
        id: $scope.count
      });
    };
  });

  app.controller('backendHomeCtrl', function($scope, $element, $http) {
    return $scope.removeQuiz = function(event) {
      var id, link;
      id = void 0;
      link = void 0;
      id = $(event.target).attr('id');
      link = $(event.target).attr('href');
      if (confirm('Delete quiz?') === true) {
        return true;
      } else {
        return false;
      }
    };
  });

}).call(this);

//# sourceMappingURL=backend.js.map
