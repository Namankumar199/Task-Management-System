
document.addEventListener('DOMContentLoaded', function () {

    var all_status1 = document.querySelectorAll(".status");
    var all_action_btn1 = document.querySelectorAll(".action_btn");
    var aViews1 = document.getElementsByClassName('aView');
    var aEdits1 = document.getElementsByClassName('aEdit');
    var aDeletes1 = document.getElementsByClassName('aDel');

    var userName = document.querySelector('.usernameh2').innerText;

    var draggableTodo1 = null;

    function myDragStart() {
        console.log("dragstart");
        draggableTodo1 = this;
    }

    function myDragEnd() {
        draggableTodo1 = null;
        console.log("dragend");
    }

    all_action_btn1.forEach((btn) => {
        btn.addEventListener("dragstart", myDragStart);
        btn.addEventListener("dragend", myDragEnd);
    });

    all_status1.forEach((status) => {
        status.addEventListener("dragover", myDragOver);
        status.addEventListener("dragenter", myDragEnter);
        status.addEventListener("dragleave", myDragLeave);
        status.addEventListener("drop", myDragDrop);
    });

    function myDragEnter() {
        this.style.border = "3px dashed #000";
        console.log("drag enter");
    }

    function myDragOver(e) {
        e.preventDefault();
        console.log("drag over");
    }

    function myDragLeave() {
        this.style.border = "none";
        console.log("drag leave");
    }

    function myDragDrop() {
        this.style.border = "none";
        console.log("drop here");
        var num = Number(this.cells[0].innerHTML.trim());
        var username1 = this.childNodes[3].innerHTML;
        var data = draggableTodo1.innerHTML;
        console.log("data ->  " + data);


        if (data == "View") {
            aViews1[num].click();
        } else if (data == "Edit") {
            aEdits1[num].click();
        } else if ((data == "Delete") && (userName !== username1)) {
            aDeletes1[num].click();
        }
    }

});