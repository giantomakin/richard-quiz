app = angular.module('backendApp', [ 'ngRoute' ])
app.controller 'backendCtrl', ($scope, $element, $http) ->
  question_id = undefined
  $scope.count = 1
  question_id = $element.find('#question_id').val()
  $http(
    method: 'GET'
    url: '/quiz/api/' + question_id
    headers: 'Content-type': 'application/json').then ((response) ->
    jsonData = undefined
    $scope.quiz = response.data
    if $scope.quiz.data != ''
      jsonData = JSON.parse($scope.quiz.data)
      if $scope.quiz.data_img != ''
        $scope.imgs = JSON.parse($scope.quiz.data_img)
      else
        $scope.imgs = ''
      if $scope.quiz.results != ''
        $scope.results = JSON.parse($scope.quiz.results)
      else
        $scope.results = ''
      if Object::toString.call(jsonData) == '[object Array]'
        $scope.items = jsonData
      else
        $scope.items = $.map(jsonData, (el) ->
          el
        )
    else
      $scope.items = []
  ), (response) ->
    throw new Error(response.responseText)
    return

  $scope.removeAnswer = (array, index) ->
    array.splice index, 1

  $scope.addAnswer = (data) ->
    $scope.count++
    $scope.items.push id: $scope.count

app.controller 'backendHomeCtrl', ($scope, $element, $http) ->

  $scope.removeQuiz = (event) ->
    id = undefined
    link = undefined
    id = $(event.target).attr('id')
    link = $(event.target).attr('href')
    if confirm('Delete quiz?') == true
      true
    else
      false
