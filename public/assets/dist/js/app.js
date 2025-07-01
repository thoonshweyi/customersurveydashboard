// // $(document).ready(function(){

// // 		// Start Left Side Bar
// // 		$(".sidebarlinks").click(function(){
// // 				$(".sidebarlinks").removeClass("currents");
// // 				$(this).addClass("currents");
// // 		});
// // 		// End Left Side Bar
// // });

// // Start Js Area


// // Start Site Setting
// const getsitesettings = document.getElementById("sitesettings");
// getsitesettings.addEventListener("click",function(){
// 	document.body.classList.toggle("show-nav");
// });
// // End Site Setting

// // Start Top Sidebar
// // start notify & userlogout

// // start dropdown
// function dropbtn(e){
// 		console.log(e);

// 		e.target.parentElement.nextElementSibling.classList.toggle('show');
// }
// document.getElementById("noticenter").addEventListener("click",function(e){
// 	e.target.parentElement.nextElementSibling.classList.toggle('show');
// });

// // end dropdown

// // end notify & user logout
// // End Top Sidebar

// // Start Gauge Area



//  var gaugecus = new JustGage({
// 	id: "gaugecustomers", // the id of the html element
// 	width : 200,
// 	height: 200,
// 	value: 7000000,
// 	min: 0,
// 	max: 9000000,
// 	gaugeWidthScale: 0.6
//  });

//  var gaugeemps = new JustGage({
// 	id: "gaugeemployees", // the id of the html element
// 	width : 200,
// 	height: 200,
// 	value: 80,
// 	min: 0,
// 	max: 100,
// 	gaugeWidthScale: 0.6
//  });

// //  var gaugeinvs = new JustGage({
// // 	id: "gaugeinverters", // the id of the html element
// // 	width : 200,
// // 	height: 200,
// // 	value: 40,
// // 	min: 0,
// // 	max: 50,
// // 	gaugeWidthScale: 0.6
// //  });


// // update the value randomly
// // setInterval(() => {
// // 	gaugeurs.refresh(Math.random() * 100);
// // 	gaugecus.refresh(Math.random() * 100);
// // 	gaugeemps.refresh(Math.random() * 100);
// // 	gaugeinvs.refresh(Math.random() * 100);
// // }, 5000);



// // End Guague Area

// // 22GG



// // End Js Area



// // --------------------------------------------------

// // let result = Math.min(10,20,5,6,8,2,60,18,7);
// // console.log(result);
// // let results = Math.max(10,20,5,6,8,2,60,18,7);
// // console.log(results);

// // Get Min number
// // var arrnums = [5,10,15,3,7,8,20,6];

// // function getminnumber(numbers){
// // 	let minnumber = numbers[0];
// // 	for(var x=0; x<numbers.length; x++){
// // 		// Get Mini Number
// // 		if(numbers[x] < minnumber){
// // 			minnumber = numbers[x];
// // 		}

// // 		// Get Mini Number
// // 		// if(numbers[x] > minnumber){
// // 		// 	minnumber = numbers[x];
// // 		// }
// // 	}


// // 	return minnumber;
// // }

// // console.log(getminnumber(arrnums));

// // var arrnumstwo = [5,10,15,3,7,8,20,6];

// // function sortmaxtominnum(numbers){

// // 	for(let y=0; y<numbers.length; y++){
// // 		// let maxnumber = numbers[0];
// // 		// let curidx;

// // 		let maxnumber = numbers[y];
// // 		let curidx;

// // 		// for(let x=0; x<numbers.length; x++){
// // 		for(let x=y; x<numbers.length; x++){
// // 			// Get Max  Number
// // 			if(numbers[x] > maxnumber){
// // 				maxnumber = numbers[x];
// // 				curidx = x;
// // 			}

// // 			// Get Min  Number
// // 			// if(numbers[x] < maxnumber){
// // 			// 	maxnumber = numbers[x];
// // 			// 	curidx = x;
// // 			// }
// // 		}
// // 		// return maxnumber; //20

// // 		// return [maxnumber,curidx]; //[20,6]

// // 		// swap idx6 to idx0
// // 		// numbers[curidx] = numbers[0]; //5
// // 		// // return [maxnumber,curidx,numbers] // 20 5 [5,10,15,3,7,8,5,6]
// // 		// numbers[0] = maxnumber; //20
// // 		// return [maxnumber,curidx,numbers]; // 20 5 [20,10,15,3,7,8,5,6]

// // 		numbers[curidx] = numbers[y];
// // 		numbers[y] = maxnumber;
// // 	}
// // 	return numbers;


// // }

// // console.log(sortmaxtominnum(arrnumstwo));



// // ---------------------------------------------
// let saledatas = [
// 	{
// 		title : "Order Value",
// 		rank : 80,
// 		value: "120.8%",
// 		color : "bg-secondary"
// 	},
// 	{
// 		title : "Total Products",
// 		rank : 50,
// 		value: "325.2%",
// 		color : "bg-success"
// 	},
// 	{
// 		title : "Quantity",
// 		rank : 70,
// 		value: "25.60%",
// 		color : "bg-warning"
// 	}
// ];

// var arrnumstwo = [5,10,15,3,7,8,20,6];

// function sortmaxtominnum(numbers){

// 	for(let y=0; y<numbers.length; y++){
// 		let maxnumber = numbers[y];
// 		let curidx;


// 		for(let x=y; x<numbers.length; x++){
// 			// Get Max  Number
// 			if(numbers[x] > maxnumber){
// 				maxnumber = numbers[x];
// 				curidx = x;
// 			}

// 		}

// 		numbers[curidx] = numbers[y];
// 		numbers[y] = maxnumber;
// 	}
// 	return numbers;


// }
// // console.log(sortmaxtominnum(arrnumstwo));

// function showsaledatas(sortdatas){
// 	let getsalectn = document.getElementById("salecontainer");
// 	let progress;

// 	for(let x=0; x<3;x++){
// 		progress += `
// 		<div class="mt-2">
// 			<div class="d-flex justify-content-between">
// 			<small>Order Value</small>
// 			<small>120.8%</small>
// 			</div>
// 			<div class="progress">
// 			<div class="progress-bar bg-secondary" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
// 			</div>
// 		</div>;
// 		`;
// 	}


// 	// getsalectn.innerHTML = progress;
// }
// showsaledatas();



// // Start Footer
// 	const getyear = document.getElementById("getyear");
// 	const getfullyear = new Date().getFullYear();
// 	getyear.textContent = getfullyear;
// // End Footer



// $(document).ready(function(){
// 	// Start Lead Chat

// 	$.ajax({
// 		url: '/api/leadsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data)
// 			const ctx = document.getElementById('leadcharts');
// 			ctx.height = 250;
// 			new Chart(ctx, {
// 				type: 'doughnut',

// 				data: {
// 					labels: Object.keys(data.leadsources),
// 					datasets: [{
// 						data:  Object.values(data.leadsources),
// 						backgroundColor: ["green","blue","red"],
// 						borderWidth:1
// 					}]
// 				},
// 				options: {
// 					responsive:false
// 				}
// 			});

// 		}
// 	});
// 	// End Lead Chat

// 	// Start Age Chart
// 	$.ajax({
// 		url: '/api/studentsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data)

// 			// age analysis
// 			const agectx = document.getElementById('agechart');
// 			agectx.height = 250;
// 			new Chart(agectx, {
// 				type: 'bar',

// 				data: {
// 					labels: Object.keys(data.agegroups),
// 					datasets: [{
// 						label: 'Age Analysis',
// 						data:  Object.values(data.agegroups),
// 						backgroundColor: "steelblue",
// 						borderWidth:1
// 					}]
// 				},
// 				options: {
// 					responsive:true,
// 					scales: {
// 						y:{
// 							beginAtZero: true
// 						}
// 					}
// 				}
// 			});


// 			// student chart

// 			$('#studentcount').text(data.totalstudents);
// 			var gaugeurs = new JustGage({
// 				id: "studentchart", // the id of the html element
// 				width : 200,
// 				height: 200,
// 				value: data.activestudents,
// 				min: 0,
// 				max: data.totalstudents,
// 				gaugeWidthScale: 0.6
// 			 });
// 		}
// 	});
// 	// End Age Chart


// 	// Start Leave Chart
// 	$.ajax({
// 		url: '/api/leavesdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data);

// 			const datas = [
// 				{icon:'fas fa-users',label: "Total Leaves",value:data.totalleaves},
// 				{icon:'fas fa-check-circle',label: "Approved Leaves",value:data.approved},
// 				{icon:'fas fa-hourglass-half',label: "Pending Leaves",value:data.pending},
// 				{icon:'fas fa-times-circle',label: "Rejected Leaves",value:data.rejeted},

// 			];

// 			let html = '';
// 			$.each(datas,function(idx,data){
// 				html += `
// 				<div class="col-md-3 col-sm-6">
// 					<div class="card-body">
// 						<div class="d-flex justify-content-center align-items-center">
// 							<i class="${data.icon} fa-2x text-primary me-4"></i>
// 							<div class="text-center">
// 								<p class="text-dark mb-0">${data.label}</p>
// 								<h5 class="fw-bold text-dark mb-0">${data.value}</h5>
// 							</div>
// 						</div>
// 					</div>
// 				</div>
// 				`;

// 				$('#leavechart').html(html);
// 			})

// 		},
// 		error:function(){
// 			$('#leavechart').html('<span class="text-danger">Failed to load leave data.<span>')
// 		}
// 	});
// 	// End Leave Chart


// 	// Start Enrolls Chart
// 	$.ajax({
// 		url: '/api/enrollsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data);


// 			$('#enrollcount').text(data.totalenrolls);
// 			let $percentages = data.percentages;

// 			let html = '';
// 			$.each($percentages,function(stage,data){
// 				let percent = data.percentage;
// 				let progresscolor = '';
// 				if(percent <= 20){
// 					progresscolor = 'bg-danger'
// 				}else if(percent <= 40){
// 					progresscolor = 'bg-warning'
// 				}else if(percent <= 60){
// 					progresscolor = 'bg-primary'
// 				}else if(percent <= 80){
// 					progresscolor = 'bg-info'
// 				}else{
// 					progresscolor = 'bg-success'
// 				}
// 				html += `
// 				<h4 class="small">${stage} <span>${percent}%</span></h4>
// 				<div class="progress mb-2">
// 					<div class="progress-bar ${progresscolor}" style="width: ${percent}%;" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100"></div>
// 				</div>
// 				`;

// 			});

// 			$('#enrollchart').html(html);

// 		},
// 		error:function(){
// 			$('#enrollchart').html('<span class="text-danger">Failed to load leave data.<span>')
// 		}
// 	});
// 	// End Enrolls Chart

// 	// Start User Chart
// 	$.ajax({
// 		url: '/api/usersdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data)

// 			$('#usercount').text(data.totalusers);
// 			var gaugeurs = new JustGage({
// 				id: "userchart", // the id of the html element
// 				width : 200,
// 				height: 200,
// 				value: data.onlineusers,
// 				min: 0,
// 				max: data.totalusers,
// 				gaugeWidthScale: 0.6
// 			 });
// 		},
// 		error: function(){
// 			$('#usercount').text("Error loading data");
// 		}
// 	});
// 	//  End User Chart


// 	// Start Posts Chart
// 	$.ajax({
// 		url: '/api/postsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data);

// 			let html = '';
// 			$.each(data,function(idx,post){


// 				html += `
// 					<tr>
// 						<td>
// 							<div class="d-flex">
// 								<img src="${post.image ?? ''}" class="img-sm me-3" width="100" alt="${post.title}" />
// 								<div>
// 									<div>Article</div>

// 								   	<a href="javascript:void(0);" class="fw-bold mt-1" onclick="postshowlink(${post.id})">${post.title}</a>
// 								</div>
// 							</div>
// 						</td>
// 						<td>
// 							Fee
// 							<div class="fw-bold mt-1">${post.fee} Ks.</div>
// 						</td>
// 						<td>
// 							Status
// 							<div class="fw-bold text-success mt-1">${post.status}</div>
// 						</td>
// 						<td>
// 							Release
// 							<div class="fw-bold mt-1">${post.created_at}</div>
// 						</td>

// 					</tr>
// 				`;

// 			});

// 			$('#postchart').html(html);

// 		},
// 		error:function(){
// 			$('#postchart').html('<span class="text-danger">Failed to load articles data.<span>')
// 		}
// 	});
// 	// End Posts Chart


// 	// Start Contact Chart
// 	$.ajax({
// 		url: '/api/contactsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data);

// 			let html = '';

// 			if(data.length > 0){
// 				$.each(data,function(idx,contact){
// 					html += `
// 						<div class="d-flex align-items-center border-bottom py-2">
// 							<img src="./assets/img/users/user1.jpg" class="rounded-circle" width="40px" height="40px" alt="user1"/>
// 							<div class="ms-3">
// 								<h6 class="mb-1 ms-1">${contact.firstname} ${contact.lastname}</h6>
// 								<small class="text-muted fw-bold mb-0"><i class="fas fa-birthday-cake me-1 text-warning"></i>${contact.birthday}</small>
// 							</div>
// 							<div class="ms-auto d-flex align-items-center">
// 								<span><i class="fas fa-user me-1 text-primary"></i>${contact.relative}</span>
// 							</div>
// 						</div>
// 					`;
// 				});
// 			}else{
// 				html += `
// 					<div class="text-center py-3">
// 						<i class="fas fa-user-slash fa-2x text-muted"></i>
// 						<p class="text-muted mt-3">No contacts available</p>
// 					</div>
// 				`;
// 			}


// 			$('#contactchart').html(html);

// 		},
// 		error:function(){
// 			$('#contactchart').html('<span class="text-danger">Failed to load contacts data.<span>')
// 		}
// 	});
// 	// End Contact Chart

// 	// Start Announcement Chart
// 	$.ajax({
// 		url: '/api/announcementsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			// console.log(data);
// 			let html = '';

// 			if(data.length > 0){
// 				$.each(data,function(idx,announcement){
// 					let imagesrc = announcement.image ? announcement.image : './assets/img/fav/favicon.png';

// 				html += `
// 				 <div class="text-center">
// 				<img src="${imagesrc}" class="" style="width:150px;" alt="${announcement.title}"/>
// 				</div>

// 				<div class="ms-3">
// 					<h6 class="mb-1 fw-bold">${announcement.title}<h6>
// 					<p class="text-muted small">${announcement.content.substring(0,300)}</p>
// 					<a href="/announcements/${announcement.id}" class="text-primary">Read More</a>
// 				</div>
// 				`;

// 				});
// 			}else{
// 				html += `
// 					<div class="text-center py-3">
// 						<i class="fas fa-user-slash fa-2x text-muted"></i>
// 						<p class="text-muted mt-3">No contacts available</p>
// 					</div>
// 				`;
// 			}


// 			$('#announcementchart').html(html);

// 		},
// 		error:function(){
// 			$('#announcementchart').html('<span class="text-danger">Failed to load contacts data.<span>')
// 		}
// 	});
// 	// End Announcement Chart


// 	// Start Comment Chart
// 	$.ajax({
// 		url: '/api/commentsdashboard',
// 		method: 'GET',
// 		success:function(data){
// 			console.log(data);
// 			let html = '';

// 			if(data.length > 0){
// 				$.each(data,function(idx,comment){
// 				html += `
// 				<li class="list-group-item border-bottom d-flex justify-content-between align-items-center py-1">
// 					<div>
// 						<strong>${comment.user.name}</strong>
// 						<span class="block">commented on ${comment.commentable.title} : (${comment.commentable.type})</span>
// 						<p class="text-muted mb-0">${comment.description}</p>
// 						<small class="text-muted">${comment.created_at}</small>
// 					</div>
// 				</li>
// 				`;

// 				});
// 			}else{
// 				html += `
// 					<li class="list-group-item text-muted">No comments available.</li>
// 				`;
// 			}


// 			$('#commentchart').html(html);

// 		},
// 		error:function(){
// 			$('#commentchart').html('<span class="text-danger">Failed to load comments data.<span>')
// 		}
// 	});
// 	// End Comment Chart
// });

// function postshowlink(id){
// 	window.location.href = `/posts/${id}`;
// 	// return 'hay'
// }
// {/* <a href="javascript:void(0);" class="fw-bold mt-1" onclick="window.location.href = '/posts/${post.id}'">${post.title}</a> */}



const footer = document.getElementById('footer');
const content = document.getElementById('contentarea');

function setFooterPadding() {
  const footerHeight = footer.offsetHeight;
  content.style.setProperty('--footer-height', `${footerHeight}px`);
}
