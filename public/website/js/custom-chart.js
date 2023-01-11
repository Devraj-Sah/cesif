

		var pieData = { coo_x: 100, coo_y:205,}, 
			pieData1 = { coo_x: 120, coo_y:45,},
			pieData2 = { coo_x: 50, coo_y:155,},
			pieData3 = { coo_x: 150, coo_y:45,};

			window.onload = function(){
				"use strict";
				var ctx = document.getElementById("chart-area").getContext("2d");
				var ctx1 = document.getElementById("chart-area1").getContext("2d");
				var ctx2 = document.getElementById("chart-area2").getContext("2d");
				var ctx3 = document.getElementById("chart-area3").getContext("2d");
				//window.myPie = new Chart(ctx).Pie(pieData);


				Chart.Type.extend({
				    // Passing in a name registers this chart in the Chart namespace
				    name: "Scatter",
				    // Providing a defaults will also register the deafults in the chart namespace
				    defaults : {
				        options: "Here",
				        available: "at this.options"
				    },
				    // Initialize is fired when the chart is initialized - Data is passed in as a parameter
				    // Config is automatically merged by the core of Chart.js, and is available at this.options
				    initialize:  function(data){
				        this.chart.ctx // The drawing context for this chart
				        //console.log(this.chart.ctx);
				        this.chart.canvas // the canvas node for this chart
				        this.data = data;
				        this.draw();
				    },
				    // Used to draw something on the canvas
				    draw: function() {

				    	//console.log(this.data);
				    	var opts = {};

				    	var ctx = this.chart.ctx;
				    	var data_x  = this.data.coo_x;
				    	var data_y  = this.data.coo_y;
				    	// set defaults
						var defaultPieColor = 'gray';
						var defaultBorder =  8;	
						var defaultBorderColor = '#6d6d6d'
						
						// don't change
						var size = 100;
						var pie = {};
						var borderRadius = size / 2;
						var radius = size / 2;
						var DEGREES_PER_RADIAN = 57.2957;
						var canvas = ("#chart-area")[0];
						//var ctx = canvas.getContext("2d"); 

						var border = opts.border ? opts.border : defaultBorder;
						var borderColor = opts.borderColor ? opts.borderColor : defaultBorderColor;
						var pieColor = opts.pieColor ? opts.pieColor : defaultPieColor;
				    	
				    	ctx.beginPath();

				    	ctx.arc(radius, radius, radius - border, 0, Math.PI*2, true); 
						ctx.lineWidth = border;
						ctx.fillStyle = '#7e7e7e';
						ctx.fill();
						ctx.strokeStyle = borderColor;
						ctx.stroke();
						ctx.fillStyle = '#ddd';
						//ctx.fillRect(radius,radius-2,2,2);
						ctx.save();


						ctx.beginPath();
						ctx.shadowBlur=2;
						//ctx.shadowOffsetY=2;
						//ctx.shadowColor="black";
				    	ctx.lineWidth = 1;
						ctx.strokeStyle = '#fff';
						//ctx2.lineJoin="round";
						ctx.moveTo(10,10);
						ctx.lineTo(50,50);
						ctx.lineTo(data_x,data_y);
						
						ctx.stroke();

						
				    }
				});

				// Now we can create a new instance of our chart, using the Chart.js API
				new Chart(ctx).Scatter(pieData);
				new Chart(ctx1).Scatter(pieData1);
				new Chart(ctx2).Scatter(pieData2);
				new Chart(ctx3).Scatter(pieData3);
			};