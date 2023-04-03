$(document).ready(function() {
  function loadCat1(page) {
    $.ajax({
      url: "/UserDb.php",
      type: "POST",
      data: {page_no :page},
      success: function(data) {
        $("#category1-list").html(data);
      }
    });
  }

  loadCat1();

  // Pagination
  $(document).on("click", "#pagination a", function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");

    loadCat1(page_id);
  });
});

$(document).ready(function() {
  function loadCat2(page) {
    $.ajax({
      url: "/UserDb.php",
      type: "POST",
      data: {page_no :page},
      success: function(data) {
        $("#category2-list").html(data);
      }
    });
  }

  loadCat2();

  // Pagination
  $(document).on("click", "#pagination a", function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");

    loadCat2(page_id);
  });
});
