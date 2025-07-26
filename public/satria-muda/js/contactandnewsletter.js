$('#mc-form').on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
        var url = "https://www.satriamuda.id/config/newsletterpro.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $('#mc-form').serialize(),
            beforeSend: function() {
              $("#loader").show();
            }, 
            complete: function() {
              $("#loader").hide();
            },
            success: function (response) {
              if (response == "ok") {
                alertify.set('notifier','position', 'bottom-left');
                alertify.success('<i class="fa fa-check"></i> Terima kasih, Silahkan konfirmasi email Anda');
                $("form")[0].reset();
              }
              else if (response == "already") {
                alertify.set('notifier','position', 'bottom-left');
                alertify.warning('<i class="fa fa-exclamation"></i> Sepertinya email Anda sudah terdaftar.');
              }
              else {
                alertify.set('notifier','position', 'bottom-left');
                alertify.error(response);
              }
          }
        });
        return false;
    }
});

$('#contact-form').on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
        var url = "https://www.satriamuda.id/config/sendcontact.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $('#contact-form').serialize(),
            beforeSend: function() {
              $("#loader").show();
            }, 
            complete: function() {
              $("#loader").hide();
            },
            success: function (response) {
              if (response == "ok") {
                alertify.set('notifier','position', 'bottom-left');
                alertify.success('<i class="fa fa-check"></i> Terima kasih, Pesan Anda telah terkirim');
                $("form")[0].reset();
              }
              else {
                alertify.set('notifier','position', 'bottom-left');
                alertify.error(response);
              }
          }
        });
        return false;
    }
});