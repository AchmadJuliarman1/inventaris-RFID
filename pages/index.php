<?php include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";?>
<?php include_once LAYOUTS_PATH."sidebar.php"; ?>

<!-- Main Content -->
  <div class="flex-grow-1 p-4">
    <h1>Main Content</h1>
    <p>Content area goes here.</p>
  </div>

<script>
Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
})
// }).then((result) => {
//   if (result.isConfirmed) {
//     Swal.fire({
//       title: "Deleted!",
//       text: "Your file has been deleted.",
//       icon: "success"
//     });
//   }
// });
</script>

<?php include_once LAYOUTS_PATH."footer.php";?>
