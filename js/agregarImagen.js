
$(document).ready(function () {
    $("#foto").on("change", function (e) {
var filename = e.target.value.split("\\").pop();
        $("#label_span").text(filename);
});
});