/**
 * The javascript for breakout game
 */
$(function() {
         // Set up canvas and context object
    	var canvas = document.getElementById('canvas'); 
    	var canvas2 = document.getElementById('canvas2');
    	var context = canvas.getContext('2d'); 
    	var context2 = canvas2.getContext('2d');

    	// Set up a lives counter
    	var lifeCounter = 3;

    	// Set up sound effects
    	var bounceSound = new Audio("bounce.ogg");
    	var eraseSound = new Audio("erase.ogg");
    	var loselife = new Audio("loselife.mp3");
    	var gameover = new Audio("gameover.mp3");
    	var gamewin = new Audio("win.ogg");
    	
    	// Set up paddle's position
    	var paddleX = 250;
    	var paddleY = 588;
    	
    	// Set up paddle's size
    	var paddleWidth = 110;
    	var paddleHeight = 10;
    	
    	// Initialize the displacement of the paddle
    	var paddleMoveX = 0;

    	// speed of the paddle
    	var paddleSpeed = 10;
    	
    	// direction of the moving paddle
    	var paddleDirection;
    	
    	// This function draws the paddle
    	function drawPaddle(){
    	    context.fillStyle = 'Red';
    	    context.fillRect(paddleX,paddleY,paddleWidth,paddleHeight);
    	}
    	
    	// Set up the ball object
    	var ballX = 305;
    	var ballY = 585;
    	
    	// Distances that the ball moved in X and Y direction
    	var ballSpeedX = 0;
    	var ballSpeedY = 0;
    	
    	// The radius of ball
    	var ballRadius = 3;

    	// This functions draws the ball
    	function drawBall(){
    	    context.beginPath();

    	    // Draw arc at center ballX, ballY with radius ballRadius
    	    context.arc(ballX,ballY,ballRadius,0,Math.PI*2,true);

    	    // Fill up the path
    	    context.fillStyle = 'Red';
    	    context.fill(); 
    	}
    	
    	// Set up bricks
    	var bricksPerRow = 14;                               
    	var brickHeight = 15;
    	var brickWidth = canvas.width/bricksPerRow;

    	// layout of bricks, 1 is yellow, 2 is green, 3 is orange, 4 is red, 0 means no brick
    	var bricks = [
    	    [0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    	    [0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    	    [4,4,4,4,4,4,4,4,4,4,4,4,4,4],
    	    [4,4,4,4,4,4,4,4,4,4,4,4,4,4],
    	    [3,3,3,3,3,3,3,3,3,3,3,3,3,3],
    	    [3,3,3,3,3,3,3,3,3,3,3,3,3,3],
    	    [2,2,2,2,2,2,2,2,2,2,2,2,2,2],
    	    [2,2,2,2,2,2,2,2,2,2,2,2,2,2],
    	    [1,1,1,1,1,1,1,1,1,1,1,1,1,1],
    	    [1,1,1,1,1,1,1,1,1,1,1,1,1,1],
    	];


    	// iterate through the bricks array and draw each brick using drawBrick()
    	function createBricks(){
    	    for (var i=0; i < bricks.length; i++) {
    	        for (var j=0; j < bricks[i].length; j++) {
    	        	if (bricks[i][j] != 0){
    	        		drawBrick(j,i,bricks[i][j]);
    	        	}
    	        }
    	    }
    	}

    	// draw a single brick
    	function drawBrick(x,y,type){   
    	    switch(type){ // if brick is still visible; three colors for three types of bricks
    	        case 1:
    	            context.fillStyle = 'yellow';
    	            break;
    	        case 2: 
    	            context.fillStyle = 'green';                     
    	            break;
    	        case 3:
    	            context.fillStyle = 'orange';
    	            break;       
    	        case 4:
    	            context.fillStyle = 'red';
    	            break;                              
    	        default:
    	            context.clearRect(x*brickWidth,y*brickHeight,brickWidth,brickHeight);
    	            break;

    	    }
    	    if (type){
    	        // Fill colors for bricks
    	        context.fillRect(x*brickWidth,y*brickHeight,brickWidth,brickHeight);
    	        // Draw borders around bricks
    	        context.strokeRect(x*brickWidth+1,y*brickHeight+1,brickWidth-2,brickHeight-2);
    	    } 
    	}   

		// Draw score board
    	var score = 0;
    	 
    	function displayScoreBoard(){
    	    //Set the text font and color
    	    context2.fillStyle = 'green';
    	    context2.font = "20px Times New Roman";
    	    
    	    //Clear the bottom 40 pixels of the canvas
    	    context2.clearRect(0,canvas2.height-30,canvas2.width,25);  
    	    // Write Text 5 pixels from the bottom of the canvas
    	    context2.fillText('Score: '+score,10,canvas2.height-5);
    	}
    	 
    	// Draw lives board
    	function displayLives(){
    	    //Set the text font and color
    	    //Clear the bottom 50 pixels of the canvas
    	    context2.clearRect(0,canvas2.height-50,canvas2.width*2,30);  
    	    // Write Text 25 pixels from the bottom of the canvas
    	    context2.fillText('Lives: '+lifeCounter,10,canvas2.height-23);
    	}
    	
    	// create paddle and ball which are movable
    	function animate () {
    	    context.clearRect(0,0,canvas.width,canvas.height);
    	    drawPaddle();
    	    drawBall();
    	    createBricks();
    	    displayScoreBoard();
    	    displayLives();
    	    moveBall();
    	    movePaddle();
    	}

    	var gameLoop;
    	// Functions to start and end the game
    	function startGame(){
    		// Initialize the speed of ball with 4 towards top
    	    ballSpeedY = -4;
    	    ballSpeedX = 2;
    	    paddleDirection = 'NONE';
    	    paddleMoveX = 0;
    	    // call the animate() function every 20ms until clearInterval(gameLoop) is called
    	    gameLoop = setInterval(animate,20);
    	    
    	    // Start Tracking Keys movements,
    	    // the code of left key is 39 and the right is 37
    	    $(document).keydown(function(evt) {
    	        if (evt.keyCode == 39) {
    	            paddleDirection = 'RIGHT';
    	        } else if (evt.keyCode == 37){
    	            paddleDirection = 'LEFT';
    	        }
    	    });         
    	 
    	    $(document).keyup(function(evt) {
    	        if (evt.keyCode == 39) {
    	            paddleDirection = 'NONE';
    	        } else if (evt.keyCode == 37){
    	            paddleDirection = 'NONE';
    	        }
    	    }); 
    	    
    	}
    	
    	// This function does the ball moving animation
    	function moveBall(){
    		
    		    // If top of the ball touches the top of the screen then reverse Y direction
    		    if (ballY + ballSpeedY - ballRadius < 0 || collisionYWithBricks()){
        		        ballSpeedY = -ballSpeedY;
        		        bounceSound.play();
    		    }
    		    
    		    // Shrink the paddle when it passed the red row
    		    if (ballY < 30) {
    		    	if (!shrinked){
    		    		shrinkPaddle();
    		    	}
    		    }
    		    // If the bottom of the ball touches the bottom of the screen then 
    		    // reduce number of lives, if lives == 0 then end the game
    		    if (ballY + ballSpeedY + ballRadius > canvas.height){
    		    	if (lifeCounter <= 1){
    		    		gameover.play();
    		    		lifeCounter = 0;
    		    	    displayLives();
    		    		endGame();
    		    	} else {
        		    	lifeCounter --;
        		    	loselife.play();
    		    		// Reset positions of paddle and ball
    		        	paddleX = 250;
    		        	paddleY = 588;
    		        	ballX = 300;
    		        	ballY = 583;
    	    	        ballSpeedY = -4;
    	    	        ballSpeedX = 2;
    		        	continueCheck = true;
    		    		continueGame();
    		    	}
    		    }
    		 
    		    // If side of ball touches either side of the wall then reverse X direction
    		        //left of ball moves too far left
    		    if ((ballX + ballSpeedX - ballRadius < 0) ||
    		        //or right side of ball moves too far right
    		    (ballX + ballSpeedX + ballRadius > canvas.width) ||
    		    collisionXWithBricks()){ 
    		    		ballSpeedX = -ballSpeedX;
    		    		bounceSound.play();
    		    }

    	    	// Bounce back if the ball touches top of the paddle
    	    	if (ballY + ballSpeedY + ballRadius >= paddleY){
    	    	    // and it is positioned between the two ends of the paddle (is on top)
    	    	    if (ballX + ballSpeedX >= paddleX && 
    	    	        ballX + ballSpeedX <= paddleX + paddleWidth){
    	    	        ballSpeedY = - ballSpeedY;
    	    	        bounceSound.play();
    	    	    }
    	    	}
    	    	
    	    	// Increase the ball speed if it makes contact with Orange or Red row
    	    	if (ballY == 60 || ballY == 90) {
    	    		// Increase the speed if and only if the ball didn't make contact
    	    		if(!contacted){
        	    		increaseBallSpeed();
    	    		}
    	    	}
    		    
    		    // Move the ball
    		    ballX = ballX + ballSpeedX;
    		    ballY = ballY + ballSpeedY;
    	}
    	
    	// This function shrinks the paddle
    	var shrinked = false;
    	function shrinkPaddle(){
    		paddleWidth = paddleWidth/2;
    		shrinked = true;
    	}
    	
    	// This function increases the ball speed
    	var contacted = false;
    	function increaseBallSpeed(){
    		ballSpeedX ++;
    		ballSpeedY --;
    		contacted = true;
    	}
 
    	// This function does the paddle moving animation
    	function movePaddle(){
    	    if (paddleDirection == 'LEFT'){
    	        paddleMoveX = -paddleSpeed;
    	    } else if (paddleDirection == 'RIGHT'){
    	        paddleMoveX = paddleSpeed;
    	    } else {
    	        paddleMoveX = 0;
    	    }
    	    // Update the paddle position and prevent it from going through the border
    	    if (paddleX + paddleMoveX < 0 || paddleX + paddleMoveX +paddleWidth > canvas.width){
    	        paddleMoveX = 0; 
    	    }
    	    paddleX = paddleX + paddleMoveX;
    	}
    	
    	// Erase the brick when it's collided with the ball horizontally
    	function collisionXWithBricks(){
    	    var bumpedX = false;    
    	    for (var i=0; i < bricks.length; i++) {
    	        for (var j=0; j < bricks[i].length; j++) {
    	            if (bricks[i][j]){ // if brick is still visible
    	                var brickX = j * brickWidth;
    	                var brickY = i * brickHeight;
    	                if (
    	                    // barely touching from left
    	                    ((ballX + ballSpeedX + ballRadius >= brickX) &&
    	                    (ballX + ballRadius <= brickX))
    	                    ||
    	                    // barely touching from right
    	                    ((ballX + ballSpeedX - ballRadius <= brickX + brickWidth)&&
    	                    (ballX - ballRadius >= brickX + brickWidth))
    	                    ){      
    	                    if ((ballY + ballSpeedY -ballRadius <= brickY + brickHeight) &&
    	                        (ballY + ballSpeedY + ballRadius >= brickY)){                                                    
    	                        // weaken brick and increase score
    	                    	hitTracker();
    	                        eraseBrick(i,j);
    	                        bumpedX = true;
    	                    }
    	                }
    	            }
    	        }
    	    }
    	        return bumpedX;
    	}               

    	var hitCounter = 0;
    	function hitTracker(){
        	hitCounter ++;
        	if (hitCounter == 4 || hitCounter == 12){
        		ballSpeedX = ballSpeedX*1.25;
        		ballSpeedY = ballSpeedY*1.25;
        	}
    		
    	}
    	// Erase the brick when it's collided with the ball vertically
    	function collisionYWithBricks(){
    	    var bumpedY = false;
    	    for (var i=0; i < bricks.length; i++) {
    	        for (var j=0; j < bricks[i].length; j++) {
    	            if (bricks[i][j]){ // if brick is still visible
    	                var brickX = j * brickWidth;
    	                var brickY = i * brickHeight;
    	                if (
    	                    // barely touching from below
    	                    ((ballY + ballSpeedY - ballRadius <= brickY + brickHeight) && 
    	                    (ballY - ballRadius >= brickY + brickHeight))
    	                    ||
    	                    // barely touching from above
    	                    ((ballY + ballSpeedY + ballRadius >= brickY) &&
    	                    (ballY + ballRadius <= brickY ))){
    	                    if (ballX + ballSpeedX + ballRadius >= brickX && 
    	                        ballX + ballSpeedX - ballRadius <= brickX + brickWidth){                                      
    	                        // weaken brick and increase score
    	                    	hitTracker();
    	                        eraseBrick(i,j);
    	                        bumpedY = true;
    	                    }                       
    	                }
    	            }
    	        }
    	    }
    	    return bumpedY;
    	}

    	// Erase the brick when it's collided with the ball
	var lifeRecord;
    	function eraseBrick(i,j){   
    	    switch(bricks[i][j]){ // if brick is still visible; three colors for three types of bricks
	        	case 1:
	        		score ++;
	        		break;
	        	case 2: 
	        		score = score + 3;                     
	        		break;
	        	case 3: 
	        		score = score + 5;
	        		break;       
	        	case 4: 
	        		score = score + 7;
	        		break;                              
	        	default:
	        		context.clearRect(x*brickWidth,y*brickHeight,brickWidth,brickHeight);
	            	break;

	        }
    	    // erase the brick (0 means brick has gone)
    	    bricks[i][j] = 0;
    	    eraseSound.play();
    	    // Player win if score exceeds the total
    	    
    	    if (score == 448){
    	    	// Start the second level
		lifeRecord = lifeCounter;
    	    	continueCheck = true;
        	    continueGame();
        	    retry = true;
    	    	resetGame();
		lifeCounter = lifeRecord;
    	    	score = 448;
    	    	
    	    } else if (score >= 896){
    	    	gamewin.play();
    	    	winGame();
    	    }
    	}
    	
    	
	    resetGame();
	    context.fillStyle = 'Blue';
	    context.fillText('Press Enter to start',canvas.width/2 - 60,canvas.height/2);
	    $(document).keypress(function(evt) {
	        if (evt.keyCode == 13) {
	    	    startGame();
	        }
	    });
    	 
    	// Call this function to end the game
    	var retry = false;
    	function endGame(){
    	    clearInterval(gameLoop);
    	    context.fillStyle = 'Brown';
    	    context.fillText('GAME OVER',canvas.width/2 - 60,canvas.height/2);
    	    context.fillText('Press Enter to try again',canvas.width/2 - 60,canvas.height/2+30);
    	    $(document).keypress(function(evt) {
    	        if (evt.keyCode == 13) {
    	        	retry = true;
    	        	resetGame();
    	    	    restartGame();
    	        }
    	    });
    	}
    	 
    	// This function resets the game data
    	function resetGame(){
    	    context.clearRect(0,0,canvas.width,canvas.height);
        	paddleX = 250;
        	paddleY = 588;
        	paddleWidth = 110;
        	ballX = 305;
        	ballY = 585;
        	ballSpeedY = -4;
        	ballSpeedX = 2;
        	lifeCounter = 3;
        	score = 0;
        	hitCounter = 0;
		contacted = false;
		shrinked = false;
            bricks = [
              	    [0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            	    [0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            	    [4,4,4,4,4,4,4,4,4,4,4,4,4,4],
            	    [4,4,4,4,4,4,4,4,4,4,4,4,4,4],
            	    [3,3,3,3,3,3,3,3,3,3,3,3,3,3],
            	    [3,3,3,3,3,3,3,3,3,3,3,3,3,3],
            	    [2,2,2,2,2,2,2,2,2,2,2,2,2,2],
            	    [2,2,2,2,2,2,2,2,2,2,2,2,2,2],
            	    [1,1,1,1,1,1,1,1,1,1,1,1,1,1],
            	    [1,1,1,1,1,1,1,1,1,1,1,1,1,1],
        	      	];
        	drawPaddle();
    	    drawBall();
    	    createBricks();
    	    displayScoreBoard();
    	    displayLives();
    	}
    	
    	// This function restarts the game
    	function restartGame(){
    		if (retry == true) {
    			clearInterval(gameloop);
    			retry = false;
    			restartGame();
    		} else {
        	    // call the animate() function every 20ms until clearInterval(gameLoop) is called
        	    gameLoop = setInterval(animate,20);
        	    
        	    // Start Tracking Keys movements,
        	    // the code of left key is 39 and the right is 37
        	    $(document).keydown(function(evt) {
        	        if (evt.keyCode == 39) {
        	            paddleDirection = 'RIGHT';
        	        } else if (evt.keyCode == 37){
        	            paddleDirection = 'LEFT';
        	        }
        	    });         
        	 
        	    $(document).keyup(function(evt) {
        	        if (evt.keyCode == 39) {
        	            paddleDirection = 'NONE';
        	        } else if (evt.keyCode == 37){
        	            paddleDirection = 'NONE';
        	        }
        	    });
    			
    		}
    	}

    	// This function continues the game after a 3 secs countdown
    	var continueCheck = false;
    	function continueGame(){
    		if (continueCheck == true) {
        	    clearInterval(gameLoop);
        	    context.fillStyle = 'Blue';
        	    context.fillText('Game continues in 3 seconds',canvas.width/2 - 60,canvas.height/2);
        	    continueCheck = false;
        		setTimeout(function(){continueGame()}, 3000);
    		} else {
        	    // call the animate() function every 20ms until clearInterval(gameLoop) is called
        	    gameLoop = setInterval(animate,20);
        	    
        	    // Start Tracking Keys movements,
        	    // the code of left key is 39 and the right is 37
        	    $(document).keydown(function(evt) {
        	        if (evt.keyCode == 39) {
        	            paddleDirection = 'RIGHT';
        	        } else if (evt.keyCode == 37){
        	            paddleDirection = 'LEFT';
        	        }
        	    });         
        	 
        	    $(document).keyup(function(evt) {
        	        if (evt.keyCode == 39) {
        	            paddleDirection = 'NONE';
        	        } else if (evt.keyCode == 37){
        	            paddleDirection = 'NONE';
        	        }
        	    }); 
    		}
    	}
    	
    	function winGame(){
    	    clearInterval(gameLoop);
    	    context.fillStyle = 'Blue';
    	    context.fillText('You WIN!',canvas.width/2 -60,canvas.height/2);
    	    context.fillText('Press Enter to play again',canvas.width/2 - 60,canvas.height/2+30);
    	    $(document).keypress(function(evt) {
    	        if (evt.keyCode == 13) {
    	        	retry = true;
    	        	resetGame();
    	    	    restartGame();
    	        }
    	    });
    	}
});
