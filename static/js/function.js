function myfunction() {
    let goods = document.getElementById("no_goods");
    goods.innerHTML = '';
    let sumPrice = 0;
    for (let i = 0; i < localStorage.length; i++) {

        let key = localStorage.key(i);
        let obj = '';
        try {
            obj = JSON.parse(localStorage.getItem(key));
        } catch (error) {
            continue;
        }
        let div = document.createElement("div");
        if(typeof(obj["name"]) != "undefined"
            && typeof(obj["count"]) != "undefined"
            && typeof(obj["price"]) != "undefined") {
            let info = "<div>"+ obj["name"] + '[' + obj["count"]
                + ']' + '¥' + obj["price"] + "</div>";
            div.innerHTML = info;
            sumPrice += parseInt(obj["price"]) * parseInt(obj["count"]);
            goods.appendChild(div);
        }
        // if (sumPrice + parseInt(obj["price"]) * parseInt(obj["count"]) == NaN) {
        //
        // }else {
        //     sumPrice += parseInt(obj["price"]) * parseInt(obj["count"]);
        //     goods.appendChild(div);
        // }

    }
    let sumPriceEle = document.getElementById("sumPrice");
    sumPriceEle.innerHTML = 'Total Price:' + sumPrice;
}

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

function addCart(pid) {
    // let pid = "14";
    //判断是否已经存入缓存
    if (localStorage.getItem(pid) != null) {
        //更新缓存数据
        let obj = JSON.parse(localStorage.getItem(pid));
        let num = parseInt(obj["count"]);
        let addNum = document.getElementById("itemNum").value;
        addNum = parseInt(addNum);
        num += addNum;
        obj["count"] = num.toString();

        localStorage.setItem(pid, JSON.stringify(obj));
        myfunction();
    } else {
        $.ajax({
            type: "post",
            url: "/lib/addcart.php",
            data: {pid:pid + ""},
            dataType: "json",
            success: function(msg) {
                let data = JSON.parse(msg);
                let pid = data["pid"];
                localStorage.setItem(pid, JSON.stringify(data));
                let goods = document.getElementById("no_goods");
                let div = document.createElement("div");
                let info = "<div>"+ data["name"] + '[' + data["count"]
                    + ']' + '¥' + data["price"] + "</div>" ;
                div.innerHTML = info;
                goods.appendChild(div);
            },
            error: function(msg) {
                console.log(msg);
            }
        })
    }
}

function upValue() {
    let ele = document.getElementById("itemNum");
    ele.value = parseInt(ele.value) + 1;
}

function downValue() {
    let ele = document.getElementById("itemNum");
    if (parseInt(ele.value) > 0) {
        ele.value = parseInt(ele.value) - 1;
    }
}

function decreaseOne(pid) {
    // let pid = "14";
    pid = pid + "";
    if (localStorage.getItem(pid) != null) {
        let obj = JSON.parse(localStorage.getItem(pid));
        let num = parseInt(obj["count"]);
        let addNum = 1;
        if (num > 0) {
            num -= addNum;
        }
        obj["count"] = num.toString();
        localStorage.setItem(pid, JSON.stringify(obj));
        if (num == 0) {
            localStorage.removeItem(pid);
        }
        myfunction();
    }
}

function checkNumber(theObj) {
    var reg = /^[0-9]+.?[0-9]*$/;
    if (reg.test(theObj)) {
        return true;
    }
    return false;
}

function saveOrder() {
    $.ajax({
        type: "post",
        url: "/lib/addcart.php",
        data: {pid:pid + ""},
        dataType: "json",
        success: function(msg) {
            let data = JSON.parse(msg);
            let pid = data["pid"];
            localStorage.setItem(pid, JSON.stringify(data));
            let goods = document.getElementById("no_goods");
            let div = document.createElement("div");
            let info = "<div>"+ data["name"] + '[' + data["count"]
                + ']' + '¥' + data["price"] + "</div>" ;
            div.innerHTML = info;
            goods.appendChild(div);
        },
        error: function(msg) {
            console.log(msg);
        }
    })
}

function getUserName() {
    const getCookie = (name) => document.cookie.match(`[;\s+]?${name}=([^;]*)`)?.pop();
    let a = getCookie("username");
    console.log(a)
}



///*
// * Demo1:选取一张图片，并预览
// */
//$("#img_input").on("change", function(e) {
//
//    var file = e.target.files[0]; //获取图片资源
//
//    // 只选择图片文件
//    if (!file.type.match('image.*')) {
//        return false;
//    }
//
//    var reader = new FileReader();
//
//    reader.readAsDataURL(file); // 读取文件
//
//    // 渲染文件
//    reader.onload = function(arg) {
//
//        var img = '<img class="preview" src="' + arg.target.result + '" alt="preview"/>';
//        $(".preview_box").empty().append(img);
//    }
//});
//
///*
// * Demo2:拖拽上传
// */
//// 必须阻止dragenter和dragover事件的默认行为，这样才能触发 drop 事件
//function handleFileSelect(evt) {
//    evt.stopPropagation();
//    evt.preventDefault();
//
//    var files = evt.dataTransfer.files; // 文件对象
//
//    // 处理多文件
//    var output = [];
//    for (var i = 0, f; f = files[i]; i++) {
//        output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
//            f.size, ' bytes, last modified: ',
//            f.lastModifiedDate.toLocaleDateString(), '</li>');
//    }
//    // 显示文件信息
//    document.getElementById('list').innerHTML = output.join('');
//}
//
//function handleDragOver(evt) {
//    evt.stopPropagation();
//    evt.preventDefault();
//    evt.dataTransfer.dropEffect = 'copy';
//}
//
//// Setup the dnd listeners.
//var dropZone = document.getElementById('drop_zone');
//dropZone.addEventListener('dragover', handleDragOver, false);
//dropZone.addEventListener('drop', handleFileSelect, false);
//
///*
// * Demo3:label样式
// */
//$("#img_input2").on("change", function(e) {
//
//    var file = e.target.files[0]; //获取图片资源
//
//    // 只选择图片文件
//    if (!file.type.match('image.*')) {
//        return false;
//    }
//
//    var reader = new FileReader();
//
//    reader.readAsDataURL(file); // 读取文件
//
//    // 渲染文件
//    reader.onload = function(arg) {
//
//        var img = '<img class="preview" src="' + arg.target.result + '" alt="preview"/>';
//        $("#preview_box2").empty().append(img);
//    }
//});



