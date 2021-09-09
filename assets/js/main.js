$(document).ready(function() {
    $('#date').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $('#pay-deadline').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $('#date-to').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $('#date-from').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $('.nav-links li').click(function() {
        $('ul', $(this)).toggleClass('showmy');
        $(this).toggleClass('show-border');
    });
    setTimeout(() => {

        $('.alert').css("display", "none");
    }, 3000);
    // console.log(window.innerWidth);
    const hamburger = document.querySelector(".hamburger");
    const navLinks = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-links li");

    hamburger.addEventListener("click", () => {
        navLinks.classList.toggle("open");
        links.forEach(link => {
            link.classList.toggle("fade");
        });
    });

    // links.forEach(link => {
    //     link.addEventListener("click", () => {
    //         navLinks.classList.toggle("open");
    //         links.forEach(link => {
    //             link.classList.toggle("fade");
    //         });
    //     });
    // });
    if (window.innerWidth % 2 == 0) {
        $("ul.sub-menu.last-sub").addClass("even-sub");
        $("ul.sub-menu.last-sub").removeClass("last-sub");
        $("ul.sub-menu.sec-sub").addClass("even-sec-sub");
        $("ul.sub-menu.sec-sub").removeClass("sec-sub");
    }
});