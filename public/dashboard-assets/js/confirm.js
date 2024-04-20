$("body").on("click", "#confirm", function () {
    var id = $(this).data("id");

    var url = window.location.origin + "/admin/member/confirm/" + id;

    $.ajax({
        url: url,
        method: "GET",
        dataType: "JSON",
        success: function (response) {
            if (response.status == 200) {
                Swal.fire("Berhasil!", "Berhasil Menyetujui", "success").then(
                    () => {
                        location.reload(); // Refresh halaman setelah mengklik OK
                    }
                );
            }
        },
    });
});
