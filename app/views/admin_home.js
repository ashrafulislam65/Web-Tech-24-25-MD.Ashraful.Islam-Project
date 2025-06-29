document.addEventListener("DOMContentLoaded", function () {
  // DELETE USER
  document.querySelectorAll(".btn-delete").forEach((btn) => {
    btn.addEventListener("click", function () {
      const email = this.dataset.email;
      if (confirm("Are you sure you want to delete this user?")) {
        fetch("/web-tech-project/app/controllers/user_delete_controller.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "email=" + encodeURIComponent(email),
        })
          .then((res) => res.text())
          .then((message) => {
            alert(message);
            location.reload();
          })
          .catch((err) => alert("Delete failed: " + err));
      }
    });
  });
});
