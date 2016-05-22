var data;
var current_ordering = 1;
var order_by = "nomornota";

const TABLEHEADER = "<tr><th>Nomor Nota</th><th>Waktu</th><th>Supplier</th><th>Staf</th><th></th></tr>";

function comparenumber(a, b) {
    if (a.nomornota < b.nomornota)
        return -1*current_ordering;
    else if (a.nomornota > b.nomornota)
        return 1*current_ordering;
    else 
        return 0;
}

function comparetime(a, b) {
    if (a.waktu < b.waktu)
        return -1*current_ordering;
    else if (a.waktu > b.waktu)
        return 1*current_ordering;
    else 
        return comparenumber(a, b);
}

function comparesupplier(a, b) {
    if (a.namasupplier < b.namasupplier)
        return -1*current_ordering;
    else if (a.namasupplier > b.namasupplier)
        return 1*current_ordering;
    else 
        return comparetime(a, b);
}

function comparestaf(a, b) {
    if (a.nama < b.nama)
        return -1*current_ordering;
    else if (a.nama > b.nama)
        return 1*current_ordering;
    else 
        return comparetime(a, b);
}

function loadtable() {
    
    var datepick = $("#datepicker").val();
    var date = "";
    for(var i = 0; i < 4; i++) date += datepick[i];
    date += "-";
    for(var i = 5; i < 7; i++) date += datepick[i];
    date += "-";
    for(var i = 8; i < 10; i++) date += datepick[i];
    
	// query from database
	$.ajax({
        url: 'db/pembelian_inventori_query.php',
        type: "GET",
        data: {
            "date" : date,
        },
        dataType: "json",
        success: function(result) {
            data = result;
            console.log(data);
            showtable(0);
        }
    });
    
    
	
    $("#tableselector").append("<div class='col-md-1' onclick=showtable(" + 1 + ")>" + 1 + "</div>");
    
	for(var i=1;i<data.length/15;i++) {
		$("#tableselector").append("<a class='col-md-1' onclick=showtable(" + (i+1) + ")>" + (i+1) + "</a>");
	}
	
}

function showtable(index) {
    
    if(order_by == "nomornota") data.sort(comparenumber);
    if(order_by == "waktu") data.sort(comparetime);
    if(order_by == "supploer") data.sort(comparesupplier);
    if(order_by == "staf") data.sort(comparestaf);
    
	$("#datatable").empty();
	$("#datatable").append(TABLEHEADER);
	for(var i=15*index; i < 15*index + 15 && i < data.length; i++) {
        //console.log(data[i][0]);
		$("#datatable").append("<tr class='content'><td>" + data[i].nomornota + "</td><td>" + data[i].waktu + "</td><td>" + data[i].namasupplier + "</td><td>" + data[i].nama + "</td><td><a href='detail-pembelian-inventori.php?nomornota=" + data[i].nomornota + "'>RINCIAN</a></td></tr>");
	}
    
    $("#tableselector").empty();
    
	for(var i=0;i<data.length/15;i++) {
		if(i == index)
            $("#tableselector").append("<div class='col-md-1'>" + (i+1) + "</div>");
        else
            $("#tableselector").append("<a class='col-md-1' onclick=showtable(" + i + ")>" + (i+1) + "</a>");
	}
}

function sort_by_no() {
    order_by = "nomornota";
    showtable(currentIndex);
}

function sort_by_time() {
    order_by = "waktu";
    showtable(currentIndex);
}

function sort_by_supplier() {
    order_by = "supplier";
    showtable(currentIndex);
}

function sort_by_staf() {
    order_by = "staf";
    showtable(currentIndex);
}

function toggleascdsc() {
    current_ordering *= -1;
    showtable(currentIndex);
}

$(document).ready(function () {
	var current = new Date();
	
    $("#datepicker").datepicker({dateFormat:"yy/mm/dd"}).datepicker("setDate",new Date());
    $("#datepicker").change(loadtable);
    $("#sortwaktu").click(sort_by_time);
    $("#sortnomor").click(sort_by_no);
    $("#sortsupplier").click(sort_by_supplier);
    $("#sortstaf").click(sort_by_staf);
    $("#toggleasc").click(toggleascdsc);
    
	loadtable();
});
