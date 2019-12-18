function a(rn) {
	// body...
	alert("ashgv");
	var p_id = document.getElementById("p_id");
	
	var t_id = document.getElementById("t_id");
	var t_name = document.getElementById("t_name");
	
	var table = document.getElementById("table1");

    $(document).ready(function(){
    		$("#forward").click(1000,function(){
    		
    			$("#t").slideDown(function(){

    				printInToggle(rn);


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == t) {
    t.style.display = "none";
  }
}
    			})

$(document).on('click','#btn',function(){
	window.location='forward.php';
	alert("Your task forwarded successfuly");
})
$(document).on('click','#span',function(){
	window.location='forward.php';
})  				
  })
  });
}

function printInToggle(rn){

	
	var t = document.getElementById("t");
	var r = t.insertRow(0);
	t.style.border="solid 1px black"
	r.style.border="solid 1px black"
	var c1 = r.insertCell(0);
	var c2 = r.insertCell(1);
	var c3 = r.insertCell(2);
	var c4 = r.insertCell(3);
	c1.style.border="solid 1px black"
	c2.style.border="solid 1px black"
	c3.style.border="solid 1px black"
	c1.innerHTML="<center>Project Id</center>";
	c2.innerHTML="<center>Task id</center>";
	c3.innerHTML="<center>Task Name</center>";

	c4.innerHTML="<center>Task Discription</center>";

var r1 = t.insertRow(1);
	var c1 = r1.insertCell(0);
	var c2 = r1.insertCell(1);
	var c3 = r1.insertCell(2);
	var c4 = r1.insertCell(3);
	c1.innerHTML=table1.rows[rn].cells[0].innerHTML;
	c2.innerHTML=table1.rows[rn].cells[1].innerHTML;
	c3.innerHTML=table1.rows[rn].cells[2].innerHTML;
	c4.innerHTML=table1.rows[rn].cells[3].innerHTML;

	var r2 = t.insertRow(2);
	var btn = document.createElement("BUTTON");
	btn.id="btn"
	btn.style.backgroundColor="#B3F2E5"
	btn.style.height="100%"
	btn.style.width="100%"
	btn.style.marginLeft="170%";
	btn.style.borderRadius="10px"
	 var t = document.createTextNode("Forward");
  		btn.appendChild(t);
  		r2.appendChild(btn);
var t = document.getElementById("t");
  		var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  t.style.display = "none";
}
}
