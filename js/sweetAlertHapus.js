function confirmDelete(id) {
  Swal.fire({
    title: "Anda yakin?",
    text: "Data ini akan dihapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "hapus/hapus.php?id=" + id; // pastikan path ke hapus.php benar
    }
  });
}
