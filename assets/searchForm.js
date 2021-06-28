function searchForm() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  // Id of search input
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  // Id of table
  table = document.getElementById("myTable");
  // Tag of research case
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1]; // change Index to column you want
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
