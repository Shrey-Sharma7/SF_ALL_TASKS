
var path = [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];

var currentPosition1 = [-5, -5];
currentPosition2 = [-6, -6];

var lockerCount1 = 2,
  lockerCount2 = 2;

var winCount1 = 0,
  winCount2 = 0;

var idOut1 = [];
var idOut2 = [];



$(".die-btn").on("click", turn1);


  // PLAYER 1 TURN


  function turn1() {

    $(".die-btn").off("click"); 
    $("#Roll-h").text("Turn: Player 1"); 
   
    var strnum = $("#man-die").val();
    var number = convert(strnum);

    var imgPath = "dice " + number + ".svg";
    $(".dice-img").fadeIn(100).fadeOut(100).fadeIn(100).attr("src", imgPath);
  
  
    //IF NO. IS 6


  
    if(number === 6) {
  
      if(lockerCount1 === 2){
        console.log("1works");
          idOut1.push("r1");
          move("r1", number)
          lockerCount1--;
          
  
      }
  
      else if(lockerCount1 === 1 || winCount1 === 1){
        
        $(".f1").on("click", function () {
          $(".f1").off("click");
          var id = $(this).attr("id");
  
          if(id === idOut1[0]) {
            move(id, number);
          }
  
          else {
            idOut1.push(id);
            move(id, number);
            lockerCount1--;  
          }
  
          
        }); 
  
      }
  
      else if (lockerCount1 === 0) {
        $(".f1").on("click", function () {
          $(".f1").off("click");
          var id = $(this).attr("id");
          move(id, number);
  
          
  
        });
  
      }
      $(".die-btn").on("click", turn1);
    }
   
    

  
    if(number >= 1 && number  <6) {
      
      if(lockerCount1 === 2) {
        
      }
  
      else if(lockerCount1 === 1 || winCount1 === 1) {
        move(idOut1[0], number);         
        
  
      }
  
      else if(lockerCount1 === 0) {
        $(".f1").on("click", function () {
          $(".f1").off("click");
          var id = $(this).attr("id");
          move(id, number);
  
          
        });
      }
      $(".die-btn").on("click", turn2); 
    }
  }
  


  
  
  // PLAYER 2 TURN
  



  function turn2() {

    $(".die-btn").off("click"); 
    $("#Roll-h").text("Turn: Player 2"); 

    var strnum = $("#man-die").val();
    var number = convert(strnum);
    
    var imgPath = "dice " + number + ".svg";
    $(".dice-img").fadeIn(100).fadeOut(100).fadeIn(100).attr("src", imgPath);
  


  
    //IF NO. IS 6
  


    if(number === 6) {
  
      if(lockerCount2 === 2){

          idOut2.push("b1");
          unlockB("b1", number)
          lockerCount2--;
          
  
      }
  
      else if(lockerCount2 === 1 || winCount2 === 1){
        
        $(".f2").on("click", function () {
          $(".f2").off("click");
          var id = $(this).attr("id");
  
          if(id === idOut2[0]) {
            move(id, number);
          }
  
          else {
            idOut2.push(id);
            unlockB(id, number);
            lockerCount2--;  
          }
  
        }); 
  
      }
  
      else if (lockerCount2 === 0) {
        $(".f2").on("click", function () {
          $(".f2").off("click");
          var id = $(this).attr("id");
          move(id, number);
  
          
  
        });
  
      }
      $(".die-btn").on("click", turn2);
    }
    


  
    if(number >= 1 && number  <6) {
      
      if(lockerCount2 === 2) {
        
      }
  
      else if(lockerCount2 === 1 || winCount2 === 1) {
        move(idOut2[0], number);         

  
      }
  
      else if(lockerCount2 === 0) {
        $(".f2").on("click", function () {
          $(".f2").off("click");
          var id = $(this).attr("id");
          move(id, number);
  
        });
      }
      $(".die-btn").on("click", turn1); 
    }
  }
  




function unlockB(id) {
  if (id === "b1") {
    divId = "#a" + 15;
    $("#b1").appendTo(divId);
    currentPosition2[0] = 0;
    pos = path[currentPosition2[0]];
    cutCheck("b1", pos);
  }

  if (id === "b2") {
    divId = "#a" + 15;
    $("#b2").appendTo(divId);
    currentPosition2[1] = 0;
    pos = path[currentPosition2[1]];
    cutCheck("b2", pos);
  }
}




//MOVE FUNCTION




function move(id, moveBy) {

  if (id === "r1") {
    if (currentPosition1[0] + moveBy <= 28) {
      var pos = currentPosition1[0] + moveBy;
      var divId = "#a" + pos;
      $("#r1").appendTo(divId);
      currentPosition1[0] = pos;
      cutCheck("r1", pos);
      winCheck("r1",pos, 1);

    }

  }

  if (id === "r2") {
    if (currentPosition1[1] + moveBy <= 28) {
      var pos = currentPosition1[1] + moveBy;
      var divId = "#a" + pos;
      $("#r2").appendTo(divId);
      currentPosition1[1] = pos;
      cutCheck("r2", pos);
      winCheck("r2", pos, 1);

    }

  }

  if (id === "b1") {
    if (currentPosition2[0] + moveBy <= 27) {
      var pos = path[currentPosition2[0] + moveBy];
      var divId = "#a" + pos;
      $("#b1").appendTo(divId);
      currentPosition2[0] = currentPosition2[0] + moveBy;
      cutCheck("b1", pos);
      winCheck("b1", pos, 0);

    }

  }

  if (id === "b2") {
    if (currentPosition2[1] + moveBy <= 27) {
      var pos = path[currentPosition2[1] + moveBy];
      var divId = "#a" + pos;
      $("#b2").appendTo(divId);
      currentPosition2[1] = currentPosition2[1] + moveBy;
      cutCheck("b2", pos);
      winCheck("b2", pos, 0);

    }

  }
}


// CUT CHECK FUNCTION


function cutCheck(id, pos) {
  if(id === "r1" || id === "r2") {

    if(pos === path[currentPosition2[0]]){
      $("#b1").appendTo(".icon2");
      lockerCount2 ++ ;
      currentPosition2[0] = -6;

      if(idOut2[0] === "b1"){
        idOut2.splice(0,1);
      }
      else if(idOut2[1] === "b1"){
        idOut2.pop();
      }
      
    }

    if(pos === path[currentPosition2[1]]){

      $("#b2").appendTo(".icon2");
      lockerCount2 ++ ;
      currentPosition2[1] = -6;

      if(idOut2[0] === "b2"){
        idOut2.splice(0,1);
      }
      else if(idOut2[1] === "b2"){
        idOut2.pop();
      }
    }
  }

  if(id === "b1" || id === "b2"){

    if(pos === currentPosition1[0]){

      $("#r1").appendTo(".icon1");
      lockerCount1 ++ ;
      currentPosition1[0] = -5;

      if(idOut1[0] === "r1"){
        idOut1.splice(0,1);
      }
      else if(idOut1[1] === "r1"){
        idOut1.pop();
      }
    }

    if(pos === currentPosition1[1]){

      $("#r2").appendTo(".icon1");
      lockerCount1 ++ ;
      currentPosition1[1] = -5;

      if(idOut1[0] === "r2"){
        idOut1.splice(0,1);
      }
      else if(idOut1[1] === "r2"){
        idOut1.pop();
      }
    }
  }

}


// WIN CHECK FUNCTION


function winCheck(id, current, chance1) {


  if (chance1) {
    if (current === 28){
      winCount1++;
      if(id === "r1"){

        $("#r1").appendTo(".win-box");
        currentPosition1[0] = 100;
      }

      else if(id === "r2"){

        $("#r2").appendTo(".win-box");
        currentPosition1[1] = 101;

      }

      if (winCount1 === 2) {
        $("#Roll-h").text("Player 1 Wins!!!");
        $(".die-btn").off("click"); 

      }
    }


    if (!chance1) {
      if (current === 14){
        winCount2++;
        if(id === "b1"){

          $("#b1").appendTo(".win-box");
          currentPosition2[0] = 200;
        }
  
        else if(id === "r2"){
          
          $("#b2").appendTo(".win-box");
          currentPosition1[1] = 201;
  
        }
      }

      if (winCount2 === 2) {
        $("#Roll-h").text("Player 2 Wins!!!");
        $(".die-btn").off("click"); 
      
      }

    }
  }
}

function convert(string) {

  switch(string){
    case "1" : return 1; break;
    case "2" : return 2; break;
    case "3" : return 3; break;
    case "4" : return 4; break;
    case "5" : return 5; break;
    case "6" : return 6; break;
    
  }
}






