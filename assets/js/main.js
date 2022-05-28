$(document).ready(function () {
	var curUrl = window.location.href;
	if (curUrl != "https://www.centuryrealestate.in/projects")
		setTimeout(() => {
			showPromotionalMoal();
		}, 5000);

	showPromotionalMoal = () => {
		let isShown = sessionStorage.getItem("isShown");
		if (isShown != "showed") {
			sessionStorage.setItem("isShown", "showed");
			$("#promotional_Modal").modal("show");
		}
	}

	$("#promotional_Modal .btn-close").on("click", function () {
		$("#promotional_Modal").modal("hide");
	});

	$(
		".plans__section .configuration .table tbody td span, .download_brochure_config, .download__brochure"
	).on("click", function (e) {
		e.preventDefault();
		$("#configurationModal").modal("show");
	});

	var project__amenities__slider = $(".project__amenities__slider");
	project__amenities__slider.owlCarousel({
		items: 1,
		loop: true,
		autoplay: false,
		autoplayTimeout: 10000,
		margin: 0,
		// animateIn: "fadeIn",
		// animateOut: "fadeOut",
		autoplayHoverPause: true,
		smartSpeed: 2500,
		dots: true,
		nav: false,
		mouseDrag: true,
	});

	$(".slide_left").on("click", function () {
		$(".project__amenities__slider .owl-prev").trigger("click");
	});

	$(".slide_right").on("click", function () {
		$(".project__amenities__slider .owl-next").trigger("click");
	});

	$plans__section__content__block = $(".plans__section__content__block");
	$plans__section__content__block.owlCarousel({
		items: 1,
		loop: false,
		autoplay: false,
		autoplayTimeout: 10000,
		margin: 0,
		// animateIn: "fadeIn",
		// animateOut: "fadeOut",
		autoplayHoverPause: false,
		smartSpeed: 1500,
		dots: true,
		nav: true,
		mouseDrag: true,
	});

	$(".prev__plan").on("click", function () {
		console.log("click");
		$(".plans__section__content__block .owl-prev").trigger("click");
	});

	$(".next__plan").on("click", function () {
		$(".plans__section__content__block .owl-next").trigger("click");
	});

	$plan__tabs = $(".plan__tabs");
	$plan__tabs
		.children()
		.children("li")
		.each(function (index) {
			$(this).attr("data-plan-position", index);
		});

	$plans__item = $(".plans__item");
	$plans__item.each(function (index) {
		$(this).attr("data-position", index);
	});

	$(document).on("click", ".plan__tabs ul li", function () {
		setTimeout(() => {
			$plans__section__content__block.trigger(
				"to.owl.carousel",
				$(this).data("plan-position")
			);
		}, 200);
	});

	$plans__section__content__block.on("changed.owl.carousel", function (e) {
		setTimeout(() => {
			var position = $(
				".plans__section__content__block .owl-item.active .plans__item"
			).attr("data-position");
			$(".plan__tabs ul li").removeClass("active");
			$(`.plan__tabs ul li:nth-child(${parseInt(position) + 1})`).addClass(
				"active"
			);

			if (
				$(".plans__section__content__block .owl-nav .owl-prev").hasClass(
					"disabled"
				)
			) {
				$(".plans__section__tab .prev__plan").addClass("disabled");
			} else {
				$(".plans__section__tab .prev__plan").removeClass("disabled");
			}

			if (
				$(".plans__section__content__block .owl-nav .owl-next").hasClass(
					"disabled"
				)
			) {
				$(".plans__section__tab .next__plan").addClass("disabled");
			} else {
				$(".plans__section__tab .next__plan").removeClass("disabled");
			}
		}, 200);
	});

	let amenitiesImgHeight = $(".project__amenities__image img").height();
	$(".project__amenities__text__inner").css("height", amenitiesImgHeight);

	$("[data-magnify=plans-gallery]").magnify({
		headerToolbar: ["close"],
		footerToolbar: [
			"zoomIn",
			"zoomOut",
			"fullscreen",
			"actualSize",
			"rotateRight",
		],
		title: false,
	});

	$("[data-magnify=project-gallery]").magnify({
		headerToolbar: ["close"],
		footerToolbar: [
			"zoomIn",
			"zoomOut",
			"prev",
			"fullscreen",
			"next",
			"actualSize",
			"rotateRight",
		],
		title: false,
	});

	$(document).on("keyup", function (e) {
		if (e.key == "Escape") $(".magnify-button-close").trigger("click");
	});

	setInterval(function () {
		scroller.update();
	},5000)
});
