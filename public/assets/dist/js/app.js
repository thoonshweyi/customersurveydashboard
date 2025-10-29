// // $(document).ready(function(){

		// Start Left Side Bar
		$(".sidebarlinks").click(function(){
				$(".sidebarlinks").removeClass("currents");
				$(this).addClass("currents");
		});
		// End Left Side Bar
// // });

// // Start Js Area


// // Start Site Setting
const getsitesettings = document.getElementById("sitesettings");
getsitesettings.addEventListener("click",function(){
	document.body.classList.toggle("show-nav");
});
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




// Start Branch Chart
$.ajax({
    url: '/api/branchesdashboard',
    method: 'GET',
    success:function(data){
        // console.log(data)

        $('#activebranchcount').text(data.activebranches);

    },
    error: function(){
        $('#activebranchcount').text("Error loading data");
    }
});
//  End Branch Chart








const footer = document.getElementById('footer');
const content = document.getElementById('contentarea');

function setFooterPadding() {
  const footerHeight = footer.offsetHeight;
  content.style.setProperty('--footer-height', `${footerHeight}px`);
}
