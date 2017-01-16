angular.module('RQ', [ 'ngRoute' ]).controller 'frontCtrl', ($scope, $element, $http) ->
  host_path = window.location.pathname.split( '/' );
  $scope.url = if host_path[1] is 'richard-quiz' then window.location.protocol + '//' + window.location.host + '/richard-quiz/public/' else window.location.protocol + '//' + window.location.host + '/';
  checkProgress = undefined
  $scope.key = $element.find('#key').val()
  $scope.count = 0
  $scope.items = []
  $scope.isLoading = true
  $scope.doneLoading = false
  $scope.checked = 0
  $scope.showResult = false
  $scope.mapObj =
    'u2019': '\''
    '2019': '\''
    '.u00a0': ' '
    'u201c': ' '
    'u201': ''
  $http(
    method: 'GET'
    url: $scope.url + 'quiz/get/' + $scope.key
    headers: 'Content-type': 'application/json').then ((response) ->
    shuffle = undefined
    str = undefined
    $scope.question = response.data.title
    $scope.quiz_id = response.data.id
    $scope.quiz = response.data
    $scope.counterJSON = response.data.data_counter
    if response.data.type == 'mc'
      $scope.results = JSON.parse(response.data.results)

    shuffle = (sourceArray) ->
      i = undefined
      j = undefined
      temp = undefined
      i = 0
      while i < sourceArray.length - 1
        j = i + Math.floor(Math.random() * (sourceArray.length - i))
        temp = sourceArray[j]
        sourceArray[j] = sourceArray[i]
        sourceArray[i] = temp
        i++
      sourceArray

    str = $scope.quiz.data
    $scope.quizArr = $.map(JSON.parse($scope.replaceAll(str, $scope.mapObj)), (el, i) ->
      el
    )
    $scope.items = shuffle($scope.quizArr)
    $scope.size = $scope.quiz.data.size
    $scope.isLoading = false
    $scope.doneLoading = true
    $element.find('#widget-container').show()
  ), (response) ->
    throw new Error(response.responseText)
    return

  $scope.replaceAll = (str, mapObj) ->
    re = undefined
    re = new RegExp(Object.keys(mapObj).join('|'), 'gi')
    str.replace re, (matched) ->
      mapObj[matched.toLowerCase()]

  $scope.result = (data) ->
    ad = undefined
    ans = undefined
    img = undefined
    label = undefined
    outcome = undefined
    ans = $(data.target).attr('id')
    label = $(data.target).data('label')
    img = $(data.target).data('img')
    ad = $(data.target).data('ad')
    outcome = $(data.target).data('outcome')
    # $scope.isLoading = true;
    # $scope.doneLoading = false;
    $http(
      method: 'post'
      url: $scope.url + 'quiz/result/' + $scope.key + '/' + ans
      headers: 'Content-type': 'application/json').then ((response) ->
      $(data.target).parent('a').addClass 'active'
      $element.find('#quizzer-loader').hide()
      $element.find('#widget-container').show()
      $scope.result = response.data.result
      $scope.img = img
      $scope.outcome = $scope.replaceAll(outcome, $scope.mapObj)
      $scope.ad = ad
      $scope.insertResult = '<div style=\'margin:15px; border:5px solid #000;\'>' + response.data.result + '<img style=\'display: block; margin-left: auto; margin-right: auto; margin-top:20px\' src=' + img + ' class=\'img-responsive img-thumbnail\'> <h2 class=\'quizzer-question text-center\'>' + $scope.outcome + '</h2> <div class=\'row\' style=\'margin-bottom: 20px\'> <div class=\'col-md-12 text-center\'> <button type=\'button\' class=\'btn btn-default btn-lg retake-btn\' onClick=\'location.reload()\'>Retake</button> </div> </div> <br><p style=\'text-align:center;\'>' + ad + '</p></div>'
      #$('.quizzer-container').empty();
      $('#result-container').html $scope.insertResult
      $('html, body').animate { scrollTop: $(document).height() }, 1000
      #$scope.isLoading = false;
      $scope.doneLoading = true
    ), (response) ->
      throw new Error(response.responseText)
      return

  checkProgress = (value) ->
    if value < 25
      return 'progress-bar-danger progress-bar'
    if value >= 25 and value <= 50
      return 'progress-bar-warning progress-bar'
    if value >= 50 and value <= 75
      return 'progress-bar-info progress-bar'
    if value >= 75 and value <= 99
      return 'progress-bar-success progress-bar'
    if value == 100
      return 'progress-bar-success'
    return

  $scope.resultPoll = (data, size) ->
    ans = undefined
    counterArr = undefined
    counters = undefined
    i = undefined
    id = undefined
    n = undefined
    progress = undefined
    r = undefined
    total = undefined
    x = undefined
    z = undefined
    ans = $(data.target).attr('id')
    id = ans - 1
    counterArr = JSON.parse($scope.counterJSON)
    counters = new Array(size)
    n = new Array(size)
    r = new Array(size)
    total = 0
    i = 0
    x = 0
    z = 0
    progress = ''
    $scope.isLoading = true
    $scope.doneLoading = false
    while i < counters.length
      if i == id
        counters[i] = counterArr[i] + 1
      else
        counters[i] = counterArr[i]
      total += counters[i]
      i++
    $http(
      method: 'post'
      url: $scope.url + 'quiz/update-counter'
      data:
        id: $scope.quiz_id
        counters: counters
      headers: 'Content-type': 'application/json').then ((response) ->
      dataArr = undefined
      results = undefined
      y = undefined
      dataArr = $.map(response.data, (value, index) ->
        [ value ]
      )
      $element.find('#quizzer-loader').hide()
      $element.find('#widget-container').show()
      while x < n.length
        n[x] = counters[x] / total
        r[x] = Math.round(n[x] * 100)
        x++
        $element.find('#quizzer-loader').hide()
        $element.find('#widget-container').show()
      results = []
      while z < r.length
        progress += '<h4 style=\'text-align:left;\'>' + dataArr[z].label + '</h4><div class=\'progress\'><div id=\'progress-' + z + '\' class=\'' + checkProgress(r[z]) + '\' role=\'progressbar\' aria-valuenow=\'40\' aria-valuemin=\'0\' aria-valuemax=\'100\' ng-model=\'per\' style=\'width:0%\'>' + r[z] + '%</div></div>'
        z++
        $scope.progress = $scope.replaceAll(progress, $scope.mapObj)
        $scope.insertResult = '<div class=\'animated slideInDown\' style=\'margin:15px; border:5px solid #000;\'> <section id=\'intro\' class=\'intro-section\' style=\'padding-top:0px\'> <div class=\'container\'> <div class=\'row\'> <div class=\'col-lg-12\'> <h1 style=\'text-align:center;\'>Poll Result</h1>' + $scope.progress + '</div> </div> <div class=\'row\' style=\'margin-bottom: 20px\'> <div class=\'col-md-12 text-center\'> <button type=\'button\' class=\'btn btn-default btn-lg retake-btn\' onClick=\'location.reload()\'>Retake</button> </div> </div> </div> </section> </div>'
        $('.quizzer-container').empty()
        $('.quizzer-container').html $scope.insertResult
        $scope.isLoading = false
        $scope.doneLoading = true
        y = 0
        results.push do ->
          results1 = undefined
          results1 = []
          while y < r.length
            $element.find('#progress-' + y).animate { width: r[y] + '%' }, 2500
            results1.push y++
          results1
      results
    ), (response) ->
      throw new Error(response.responseText)
      return

  $scope.selectChoice = (event, aid) ->
    id = undefined
    len = undefined
    value = undefined
    $(event.target).addClass 'selected'
    len = $element.find('.radio-choices.selected').length
    console.log len
    $scope.total = $scope.items.length
    value = event.currentTarget.value
    id = aid
    $http(
      method: 'post'
      url: $scope.url + 'quiz/result/mc'
      data:
        key: $scope.key
        value: value
        id: id
      headers: 'Content-type': 'application/json').then ((response) ->
      $element.find('.radio-choices-' + id).attr 'disabled', 'disabled'
      $element.find('#result-' + id).css 'display', 'block'
      $element.find('#result-ad-' + id).html response.data.ad
      $('body').animate { scrollTop: $element.find('#result-' + id).offset().top }, 'slow'
      $scope.result = response.data
      if $scope.result.response == 'true'
        $scope.checked = $scope.checked + 1
      if len == $scope.total
        $scope.showResult = true
        $scope.computeResult $scope.checked
        return $('html, body').animate({ scrollTop: $(document).height() }, 1000)
      return
    ), (response) ->
      throw new Error(response.responseText)
      return

  $scope.computeResult = (score) ->
    percentage = undefined
    percentage = score / $scope.total * 100
    if percentage < 60
      $scope.scoreresult = $scope.results[0]
      $scope.alert = 'alert-danger'
    if percentage >= 60 and percentage <= 69
      $scope.scoreresult = $scope.results[1]
      $scope.alert = 'alert-warning'
    if percentage >= 70 and percentage <= 79
      $scope.scoreresult = $scope.results[2]
      $scope.alert = 'alert-info'
    if percentage >= 80 and percentage <= 89
      $scope.scoreresult = $scope.results[3]
      $scope.alert = 'alert-primary'
    if percentage >= 90 and percentage <= 100
      $scope.scoreresult = $scope.results[4]
      return $scope.alert = 'alert-success'
    return
