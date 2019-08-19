function update_simple_ordering_callback(e) {
    if ("children" === e) {
        window.location.reload();
        return
    }
    var t = jQuery.parseJSON(e);
    var n = t.new_pos;
    for (var r in n) {
        if ("next" === r) continue;
        var i = document.getElementById("inline_" + r);
        if (null !== i && n.hasOwnProperty(r)) {
            var s = i.querySelector(".menu_order");
            if (undefined !== n[r]["menu_order"]) {
                if (null !== s) s.innerHTML = n[r]["menu_order"];
                var o = i.querySelector(".post_parent");
                if (null !== o) o.innerHTML = n[r]["post_parent"];
                var u = null;
                var a = i.querySelector(".post_title");
                if (null !== a) u = a.innerHTML;
                var f = 0;
                while (f < n[r]["depth"]) {
                    u = "— " + u;
                    f++
                }
                var l = i.parentNode.querySelector(".row-title");
                if (null !== l && null !== u) l.innerHTML = u
            } else if (null !== s) {
                s.innerHTML = n[r]
            }
        }
    }
    if (t.next) {
        jQuery.post(ajaxurl, {
            action: "simple_page_ordering",
            id: t.next["id"],
            previd: t.next["previd"],
            nextid: t.next["nextid"],
            start: t.next["start"],
            excluded: t.next["excluded"]
        }, update_simple_ordering_callback)
    } else {
        jQuery(document.querySelector(".spo-updating-row")).removeClass("spo-updating-row");
        sortable_post_table.removeClass("spo-updating").sortable("enable")
    }
}
var sortable_post_table = jQuery(document.querySelector(".wp-list-table tbody"));
sortable_post_table.sortable({
    items: "> tr",
    cursor: "move",
    axis: "y",
    containment: "table.widefat",
    scrollSensitivity: 40,
    cancel: ".inline-edit-row",
    distance: 5,
    opacity: .85,
    forceHelperSize: true,
    update: function (e, t) {
        sortable_post_table.sortable("disable").addClass("spo-updating");
        t.item.addClass("spo-updating-row");
        var n = t.item[0].id.substr(5);
        var r = false;
        var i = t.item.prev();
        if (i.length > 0) {
            r = i.attr("id").substr(5)
        }
        var s = false;
        var o = t.item.next();
        if (o.length > 0) {
            s = o.attr("id").substr(5)
        }
        jQuery.post(ajaxurl, {
            action: "simple_page_ordering",
            id: n,
            previd: r,
            nextid: s
        }, update_simple_ordering_callback);
        var u = document.querySelectorAll("tr.iedit"),
            a = u.length;
        while (a--) {
            if (a % 2 == 0) {
                jQuery(u[a]).addClass("alternate")
            } else {
                jQuery(u[a]).removeClass("alternate")
            }
        }
    }
})