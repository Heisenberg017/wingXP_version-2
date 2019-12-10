$(".sel").each(function() {
  $(this)
    .children("select")
    .css("display", "none");

  var $current = $(this);

  $(this)
    .find("option")
    .each(function(i) {
      if (i == 0) {
        $current.prepend(
          $("<div>", {
            class: $current.attr("class").replace(/sel/g, "sel__box")
          })
        );

        var placeholder = $(this).text();
        $current.prepend(
          $("<span>", {
            class: $current.attr("class").replace(/sel/g, "sel__placeholder"),
            text: placeholder,
            "data-placeholder": placeholder
          })
        );

        return;
      }

      $current.children("div").append(
        $("<span>", {
          class: $current.attr("class").replace(/sel/g, "sel__box__options"),
          text: $(this).text()
        })
      );
    });
});

$(".sel").click(function() {
  $(this).toggleClass("active");
});

$(".sel__box__options").click(function() {
  var txt = $(this).text();
  var index = $(this).index();

  $(this)
    .siblings(".sel__box__options")
    .removeClass("selected");
  $(this).addClass("selected");

  var $currentSel = $(this).closest(".sel");
  $currentSel.children(".sel__placeholder").text(txt);
  $currentSel.children("select").prop("selectedIndex", index + 1);
});

/*Form*/
jQuery(document).ready(function($) {
  tab = $(".tabs h3 a");

  tab.on("click", function(event) {
    event.preventDefault();
    tab.removeClass("active");
    $(this).addClass("active");

    tab_content = $(this).attr("href");
    $('div[id$="tab-content"]').removeClass("active");
    $(tab_content).addClass("active");
  });
});