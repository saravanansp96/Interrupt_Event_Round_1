<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert, Update, Delete Questions</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body>
<div class="col-md-12">
	<h3 align="center">Insert, Update, Delete Questions</h3>

	<div ng-app="sa_app" ng-controller="controller" ng-init="show_data()">
		<div class="col-md-4">
		   	<label>Question Number</label>
            <input type="text" name="qno" ng-model="qno" class="form-control">
            <br/>
            <label>Type</label>
            <input type="text" name="type" ng-model="type" class="form-control">
            <br/>
            <label>Text</label>
            <input type="text" name="text" ng-model="text" class="form-control">
            <br/>
						<label>Answer1</label>
            <input type="text" name="ans1" ng-model="ans1" class="form-control">
            <br/>
						<label>Answer2</label>
            <input type="text" name="ans2" ng-model="ans2" class="form-control">
            <br/>
						<label>Answer3</label>
            <input type="text" name="ans3" ng-model="ans3" class="form-control">
            <br/>
						<label>Answer4</label>
            <input type="text" name="ans4" ng-model="ans4" class="form-control">
            <br/>
						<label>Solution</label>
            <input type="text" name="sol" ng-model="sol" class="form-control">
            <br/>
            <input type="hidden" ng-model="id">
            <input type="submit" name="insert" class="btn btn-primary" ng-click="insert()" value="{{btnName}}">
		</div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>Qno</th>
                    <th>Type</th>
                    <th>Text</th>
                    <th>Answer1</th>
                    <th>Answer2</th>
                    <th>Answer3</th>
										<th>Answer4</th>
										<th>Solution</th>
										<th>Edit</th>
										<th>Delete</th>
                </tr>
                <tr ng-repeat="x in names">
                    <td>{{x.Qno}}</td>
                    <td>{{x.type}}</td>
                    <td>{{x.text}}</td>
                    <td>{{x.ans1}}</td>
										<td>{{x.ans2}}</td>
										<td>{{x.ans3}}</td>
										<td>{{x.ans4}}</td>
										<td>{{x.solution}}</td>
                    <td>
                        <button class="btn btn-success btn-xs" ng-click="update_data(x.Qno, x.type, x.text, x.ans1, x.ans2, x.ans3, x.ans4, x.solution)">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" ng-click="delete_data(x.Qno)">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
var app = angular.module("sa_app", []);
app.controller("controller", function($scope, $http) {
    $scope.btnName = "Insert";
    $scope.insert = function() {
        if ($scope.qno == null||$scope.type == null||$scope.text == null||$scope.ans1 == null||$scope.ans2 == null||$scope.ans3 == null||$scope.ans4 == null||$scope.sol == null) {
            alert("Fill all the details");
        } else {
            $http.post(
                "insert.php", {
                    'qno': $scope.qno,
                    'type': $scope.type,
                    'text': $scope.text,
										'ans1': $scope.ans1,
										'ans2': $scope.ans2,
										'ans3': $scope.ans3,
										'ans4': $scope.ans4,
										'sol': $scope.sol,
                    'btnName': $scope.btnName,
                }
            ).success(function(data) {
                alert(data);
								$scope.qno = null;
				        $scope.type = null;
				        $scope.text = null;
				        $scope.ans1 = null;
								$scope.ans2 = null;
								$scope.ans3 = null;
								$scope.ans4 = null;
								$scope.sol = null;
                $scope.btnName = "Insert";
                $scope.show_data();
            });
        }
    }
    $scope.show_data = function() {
        $http.get("display.php")
            .success(function(data) {
                $scope.names = data;
            });
    }
    $scope.update_data = function(qno1, type, text, ans1, ans2, ans3, ans4, sol1) {
        $scope.qno = qno1;
        $scope.type = type;
        $scope.text = text;
        $scope.ans1 = ans1;
				$scope.ans2 = ans2;
				$scope.ans3 = ans3;
				$scope.ans4 = ans4;
				$scope.sol = sol1;
        $scope.btnName = "Update";
    }
    $scope.delete_data = function(qno) {
        if (confirm("Are you sure you want to delete?")) {
            $http.post("delete.php", {
                    'qno': qno
                })
                .success(function(data) {
                    alert(data);
                    $scope.show_data();
                });
        } else {
            return false;
        }
    }
});
</script>
</body>
</html>
