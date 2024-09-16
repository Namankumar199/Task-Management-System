var popup = document.querySelector('.popUp');
var cross = document.querySelector('.cross');

cross.addEventListener('click', () => {
   popup.style.display = 'none';
});

function fun(count = 1) {
   if (count > 0) {
      popup.style.display = "block";
   }
   else {
      alert('project is not available');
   }
}

document.getElementById('searchInput').addEventListener('input', function () {
   var searchText = this.value.toLowerCase();
   console.log('search clicked');
   var tableRows = document.querySelectorAll('tbody tr');

   tableRows.forEach(function (row) {
      var id = String(row.cells[0].textContent).toLowerCase();
      var name = row.cells[1].textContent.toLowerCase();
      var projectCategory = row.cells[2].textContent.toLowerCase();
      var department = row.cells[3].textContent.toLowerCase();
      var status = row.cells[5].textContent.toLowerCase();

      if (id.includes(searchText)
         || name.includes(searchText)
         || projectCategory.includes(searchText)
         || department.includes(searchText)
         || status.includes(searchText)
      ) {
         row.style.display = '';
      } else {
         row.style.display = 'none';
      }
   });
});
