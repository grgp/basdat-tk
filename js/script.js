var data;
const TABLEHEADER = "<tr><th>Nomor Nota</th><th>Waktu</th><th>Supplier</th><th>Staf</th><th></th></tr>";

function loadtable() {
	// query from database
	
	// data is filled with dummy data for UI testing only
	data = [{ no : "abc999" , waktu: "05/05/2016 08:05", supplier: "good life", staf: "Po"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"},
			{ no : "abc888" , waktu: "05/05/2016 07:43", supplier: "little mansion", staf: "Lala"}];
	
	showtable(0);
	
    //$("#tableselector").append("<div class='col-md-1' onclick=showtable(" + 1 + ")>" + 1 + "</div>");
    
	//for(var i=1;i<data.length/15;i++) {
		//$("#tableselector").append("<a class='col-md-1' onclick=showtable(" + (i+1) + ")>" + (i+1) + "</a>");
	//}
	
}

function showtable(index) {
	console.log(index);
	$("#datatable").empty();
	$("#datatable").append(TABLEHEADER);
	for(var i=15*index; i < 15*index + 15 && i < data.length; i++) {
		$("#datatable").append("<tr class='content'><td>" + data[i].no + "</td><td>" + data[i].waktu + "</td><td>" + data[i].supplier + "</td><td>" + data[i].staf + "</td><td><a href='detail-pembelian-inventori.html'>RINCIAN</a></td></tr>");
	}
    
    $("#tableselector").empty();
    
	for(var i=0;i<data.length/15;i++) {
		if(i == index)
            $("#tableselector").append("<div class='col-md-1'>" + (i+1) + "</div>");
        else
            $("#tableselector").append("<a class='col-md-1' onclick=showtable(" + i + ")>" + (i+1) + "</a>");
	}
}

$(document).ready(function () {
	var current = new Date();
	$( "#datepicker" ).datepicker({dateFormat:"yy/mm/dd"}).datepicker("setDate",new Date());
	loadtable();
});
