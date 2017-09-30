(function(){

    angular
        .module("Placement")
        .controller("quiz", ListController);
    function ListController($scope, $timeout,$http,$window){
        var vm=this;
        var x;
        vm.time;
        vm.repeat;
        vm.flag=0;
        vm.quizActive = false;//instruction section
        vm.quizActive1 = true;//question section
        vm.quizActive2 = true;//do you want to submit section
        vm.quizActive3 = true;//result section
        vm.noc=0;//no of correct
        vm.activeQues=0;
        var minutes;
        var seconds;
        vm.qnos;
        vm.count;

      


        vm.activateQuiz = activateQuiz;
        function activateQuiz(){
            if(vm.search1.length==10  &&  vm.search1!=vm.search2){
          if(vm.search2==null)
          {
            vm.search2=0;
          }
          vm.chkRoll();
        }
        else {
          document.getElementById("error").innerHTML="Invalid Ph Number!";
        }

        }
        var count=0;
        var c1=0;
        vm.Counter=Counter;
        function Counter(){
        var countDownDate = new Date().getTime()+1000*60*35;
        // Update the count down every 1 second
        x = setInterval(function() {
                    // Get todays date and time
          var now = new Date().getTime();
          // Find the distance between now an the count down date
          var distance = countDownDate - now;
          // Time calculations for days, hours, minutes and seconds
          minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          seconds = Math.floor((distance % (1000 * 60)) / 1000);
          console.log(minutes+":"+seconds);

          
          // Display the result in the element with id="demo"
          document.getElementById("demo").innerHTML =  minutes + ":" + seconds;

          // If the count down is finished, write some text
          if (minutes== 0 && seconds<=1) {
            clearInterval(x);
            document.getElementById("demo").innerHTML =  minutes + ":" + seconds;
            $timeout(function () {
              vm.quizActive = true;
              vm.quizActive1 = true;
              vm.quizActive3 = false;
              vm.markup();//on timeout
              vm.insertData();
              return ;

            }, 1000);
        }
            
          }, 1000);
        //vm.$apply();
        }
        vm.prev=prev;
        function prev() {
          if(vm.activeQues!=0)
          vm.activeQues=vm.activeQues-1;
        }
        vm.next=next;
        function next()
        {
          if(vm.activeQues!=vm.Quiz.length-1)
          vm.activeQues=vm.activeQues+1;
        }

        vm.selectAnswer=selectAnswer;
        function selectAnswer(index)
        {
          vm.Quiz[vm.activeQues].selected=index;
        }

        vm.setActiveQuestion=setActiveQuestion;
        function setActiveQuestion(index)
        {
          vm.activeQues=index;
        }

        vm.Result=Result;
        function Result()//yes on submit
        {
          clearInterval(x);
          vm.quizActive = true;
          vm.quizActive1 = true;
          vm.quizActive3 = false;
          vm.markup();
          vm.insertData();
          
        }
        vm.Result1=Result1;
        function Result1()
        {
          vm.quizActive = true;
          vm.quizActive1 = false;
          vm.quizActive2 =false;
          vm.quizActive3 = true;
        }

        vm.markup=markup;
        function markup()
        {
          var ctest;
          for(var i=0;i<vm.Quiz.length;i++)
          {
            if(vm.Quiz[i].selected==vm.Quiz[i].solution)
            {
              vm.noc++;
              vm.Quiz[i].correct=true;
            }
            else {
              vm.Quiz[i].correct=false;
            }
          }
          vm.activeQues=0;
        }
        vm.getAnsClass=getAnsClass;
        function getAnsClass(index)
        {
          if(index == vm.Quiz[vm.activeQues].solution)
          return "bg-success";
          else if(index == vm.Quiz[vm.activeQues].selected)
          return "bg-danger";
        }



        vm.Start=Start;
        function Start()
        {
          /*vm.quizActive = false;
          vm.quizActive1 = true;
          vm.quizActive2 = true;
          vm.quizActive3 = true;
          vm.noc=0;
          vm.activeQues=0;
          vm.search.length=0;
          vm.search=null;*/
          $window.location.reload();
        }

        vm.chkRoll=chkRoll;
        function chkRoll(){
          var request1 = $http({
              method: "POST",
              url: "/Battle Code Round 1/PHP/roll_validate.php",
              data:{
                  ph1: vm.search1,
                  ph2: vm.search2
              },
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
          }).then(function success(data1) {
            if(data1.data=="1")
            {
              vm.getQues();
              vm.quizActive = true;
              vm.quizActive1 = false;
              vm.quizActive2 = true;
              vm.Counter();
            }
            else {
              document.getElementById("error").innerHTML="Already taken the test!";
            }
          },function error() {
            vm.flag=-1;
          });
        }

        vm.insertData=insertData;
        function insertData() {
          vm.flag=1;
          //change the ip as per
        var request = $http({
            method: "POST",
            url: "/Battle Code Round 1/PHP/insert.php",
            data:{
                ph1: vm.search1,
                ph2: vm.search2,
                score: vm.noc
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function success() {
          vm.flag=2;
          console.log("insert "+vm.search1+":"+vm.search2+":"+vm.noc);
        },function error() {
          vm.flag=-1;
        });
    }
    vm.getQues=getQues;
    function getQues() {
      vm.flag=1;
      //change the ip as per
    var request2 = $http({
        method: "GET",
        url: "/Battle Code Round 1/PHP/questins.php"
    }).then(function success(data1) {
        vm.Quiz=data1.data;
    },function error() {
      vm.flag=-1;
    });
}

      }
})();
