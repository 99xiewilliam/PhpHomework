
function showElementById(nodeId, isShow) {
    let obj = document.getElementById(nodeId);
    let show = isShow ? "block" : "none";
    obj.style.display = show;
}

function showNaviSubItems(divObj) {
    let menus = document.getElementById("all_cate").getElementsByClassName("sub_cate_box");
    for (let i = 0; i < menus.length; i++) {
        menus[i].style.display = "none";
    }

    divObj.getElementsByTagName("div")[0].style.display = "block";
}

