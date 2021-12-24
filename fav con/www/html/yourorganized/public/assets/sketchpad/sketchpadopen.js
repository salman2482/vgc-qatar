// $(document).ready(function(){
//         var json = $("#exampleFormControlTextarea1").val();
//         stage = Konva.Node.create(json, 'play-ground');
//         var courtlayer = new Konva.Layer();
//         alert(r_url);
//         Konva.Image.fromURL(r_url+'bbcourt.svg', (imageNode) => {
//         courtlayer.add(imageNode);
//         imageNode.setAttrs({
//             width: 700,
//             height: 400,
//         });
//         courtlayer.batchDraw();
//         stage.add(courtlayer);
//     });
    
// });
// $(window).load(function() {
// alert("window is loaded");
// });
var myHistory = [];
myHistory[1] = 1;
var historyIndex = 0;
var width = 700;
var height = 400;
var stage = new Konva.Stage({
    container: 'play-ground',
    width: width,
    height: height,
});
var layer = new Konva.Layer();
var courtlayer = new Konva.Layer();
Konva.Image.fromURL('assets/sketchpad/IMG/bbcourt.svg', (imageNode) => {
    courtlayer.add(imageNode);
    imageNode.setAttrs({
        width: 700,
        height: 400,
    });
    courtlayer.batchDraw();
    stage.add(courtlayer);
});
var mode;
var attacktype;
$(".toolbox-container ul li").on("click", function(e) {
    mode = $(this).attr('id');
    $(".tool").removeClass('selectedTool');
    $(this).addClass("selectedTool");
    attacktype = $(this).attr('data-attacktype');
    if (mode == "undo") {
        undo();
    }
    if (mode == "redo") {
        redo();
    }
    if (mode == "open") {
        open();
    }
});
stage.on('mousedown touchstart', function(e) {
    drawShapes(e);
})
stage.on('mouseup touchend', function() {
    isPaint = false;
    historyIndex += 1;
    myHistory.push(stage.toJSON());
    var sketchpadData = stage.toJSON();
    $("#exampleFormControlTextarea1").val(sketchpadData)
});
function undo() {
    if (historyIndex == 1) {
        $("canvas").last().remove();
        $("#undo").addClass('disableclick');
    } else if (historyIndex > 1) {
        $("#redo").removeClass('disableclick');
        var z = myHistory[historyIndex];
        historyIndex -= 1;
        stage = Konva.Node.create(z, 'play-ground');
        $('.konvajs-content').prepend('<img id="theImg" src="http://localhost/voicene/coachthem/coachthem/public/assets/images/download.jpg" />');
        stage.on('mousedown touchstart', function(e) {
            drawShapes(e);
        })
    }
}
function redo() {
    isPaint = true;
    historyIndex += 1;
    if (historyIndex > 1) {
        $("#undo").removeClass("disableclick");
    }
    var json = myHistory[historyIndex];
    stage = Konva.Node.create(json, 'play-ground');
    $('.konvajs-content').prepend('<img id="theImg" src="http://localhost/voicene/coachthem/coachthem/public/assets/images/download.jpg" />')
    isPaint = true;
    if (myHistory.length - 1 == historyIndex) {
        $("#redo").addClass("disableclick");
    }
    stage.on('mousedown touchstart', function(e) {
        drawShapes(e);
    });
}
function open() {
    //var json = localStorage.getItem("json");
    var json = $("#exampleFormControlTextarea1").val();
    stage = Konva.Node.create(json, 'play-ground');
    $('.konvajs-content').prepend('<img id="theImg" src="http://localhost/voicene/coachthem/coachthem/public/assets/images/download.jpg" />')
    // stage.find('Image').forEach((imageNode) => {
    //     const src = imageNode.getAttr('src');
    //     const image = new Image();
    //     image.onload = () => {
    //         imageNode.image(image);
    //         imageNode.getLayer().batchDraw();
    //     }
    //     image.src = src;
    // });
    stage.on('mousedown touchstart', function(e) {
        drawShapes(e);
    });
}
$(document).on('click', '#save', function() {
    localStorage.removeItem("json");
    var json = stage.toJSON();
    localStorage.setItem("json", json);
});

function drawShapes(e) {
    var iconData = icons[attacktype];
    var stage = e.currentTarget;
    if (stage.attrs.container.id == "play-ground") {
        isPaint = true;
        var pos = stage.getPointerPosition();
        $('.konvajs-content').css('cursor', 'pointer');
        if (mode == 'delete') {
            //$('.konvajs-content').css('cursor', 'url(http://localhost/voicene/coachthem/coachthem/resources/views/user/img/eraser.svg),auto');
            var shapeid = e.target.attrs.id || e.currentTarget.clickEndShape.attrs.id || e.currentTarget.children[0].children[0].attrs.id;
            var shape = stage.find('#' + shapeid);
            shape.hide();
            // console.log(e.currentTarget.clickEndShape.attrs.text);
            layer.draw();
            stage.add(layer);
        }
        if (mode == "arrow") {
            function buildAnchor(x, y) {
                if (mode == "arrow") {
                    var anchor = new Konva.Circle({
                        x: x,
                        y: y,
                        radius: 0,
                        stroke: '#666',
                        fill: '#ddd',
                        strokeWidth: 0,
                        draggable: true,
                        id: pos.x + pos.y + "Arrow",
                    });
                    layer.add(anchor);
                    anchor.on('dragmove', function() {
                        // updateDottedLines();
                    });
                    return anchor;
                }
            }
            var bezier = {
                start: buildAnchor(pos.x, pos.y),
            };
            if (mode == "arrow") {
                lineArrow = new Konva.Arrow({
                    stroke: 'orange',
                    fill: 'orange',
                    strokeWidth: 5,
                    id: pos.x + pos.y + "Arrow"
                });
            }
            layer.add(lineArrow);
            stage.add(layer);
            if (mode == "arrow") {
                stage.on('mousemove touchmove', function() {
                    if (!isPaint) {
                        return;
                    }
                    if (mode == "arrow") {
                        const newpos = stage.getPointerPosition();
                        var endbezier = {
                            end: buildAnchor(newpos.x, newpos.y),
                        };
                        var b = bezier;
                        var c = endbezier;
                        lineArrow.points([
                            b.start.x(),
                            b.start.y(),
                            c.end.x(),
                            c.end.y(),
                        ]);
                        layer.draw();
                    }
                });
            }
            stage.on('mouseup touchend', function() {
                isPaint = false;
            });
        }
        if (mode == "streightline") {
            var i = 1;
            var last_x;
            function buildAnchor(x, y) {
                if (mode == "streightline") {
                    var anchor = new Konva.Path({
                        x: x,
                        y: y,
                        data:'M14.5 18C11.5 18 10.31 13.76 9.05 9.28C8.14 6.04 7 2 5.5 2C2.11 2 2 8.93 2 9H0C0 8.63 0.0599999 0 5.5 0C8.5 0 9.71 4.25 10.97 8.74C11.83 11.8 13 16 14.5 16C17.94 16 18.03 9.07 18.03 9H20.03C20.03 9.37 19.97 18 14.5 18Z',
                        fill: 'black',
                        strokeWidth: 0,
                        draggable: true,
                        id: pos.x + pos.y + "streightline"
                    });
                    layer.add(anchor);
                    // anchor.on('dragmove', function() {
                    //     updateDottedLines();
                    // });
                    return anchor;
                }
            }
             var k = 1;
            var bezier = {
                start: buildAnchor(pos.x, pos.y),
            };
            if (mode == "streightline") {
                streightline = new Konva.Line({
                    stroke: 'black',
                    strokeWidth: 10,
                    tension: 1,
                    id: pos.x + pos.y + "streightline",
                    closed: true,
                });
            }
            layer.add(streightline);
            stage.add(layer);
            if (mode == "streightline") {
                stage.on('mousemove touchmove', function() {
                    if (!isPaint) {
                        return;
                    }
                    if (mode == "streightline") {
                        const newpos = stage.getPointerPosition();
                        var new_x = newpos.x;
                        if( i == 1) {
                            i = 2;
                            new_x = Math.round(new_x)
                            last_x = new_x + 17;
                            var endbezier = {
                                end: buildAnchor(newpos.x, newpos.y),
                            };
                            var b = bezier;
                            var c = endbezier;
                        }
                         else if(new_x > last_x) {
                            console.log(i);
                            last_x = newpos.x + 17;
                            var endbezier = {
                                end: buildAnchor(newpos.x, newpos.y),
                            };
                            var b = bezier;
                            var c = endbezier;
                        }
                        // streightline.points([
                        //     b.start.x(),
                        //     b.start.y(),
                        //     c.end.x(),
                        //     c.end.y(),
                        // ]);
                        layer.draw();
                    }
                });
            }
            stage.on('mouseup touchend', function() {
                isPaint = false;
            });
        }
        if (mode == "circ") {
            var circle = new Konva.Circle({
                x: pos.x,
                y: pos.y,
                fill: 'white',
                stroke: 'black',
                strokeWidth: 2,
                draggable: true,
                width: 12,
                height: 12,
                radius: 6,
                id: pos.x + pos.y + "circ",
            });
            layer.add(circle);
            stage.add(layer);
        }
        if (mode == "rect") {
            var rectangle = new Konva.Rect({
                x: pos.x,
                y: pos.y,
                fill: 'white',
                stroke: 'black',
                strokeWidth: 2,
                draggable: true,
                width: 12,
                id: pos.x + pos.y + "rect",
                height: 12,
            });
            layer.add(rectangle);
            stage.add(layer);
        } else if (mode == "triangle") {
            var triangle = new Konva.RegularPolygon({
                x: pos.x,
                y: pos.y,
                sides: 3,
                radius: 8,
                fill: '#fff',
                stroke: '#000',
                draggable: true,
                strokeWidth: 2,
                id: pos.x + pos.y + "triangle",
            });
            layer.add(triangle);
            stage.add(layer);
        } else if (mode == "attack") {
            var tooltip = new Konva.Label({
                x: pos.x,
                y: pos.y,
                draggable: true,
                width: 10,
                height: 10,
                radius: 5,
                id: pos.x + pos.y + "attack",
            });
            tooltip.add(
                new Konva.Tag({
                    fill: 'black'
                })
            );
            tooltip.add(
                new Konva.Text({
                    text: attacktype,
                    fontFamily: 'Calibri',
                    fontSize: 12,
                    padding: 2,
                    fill: 'white',
                    id: pos.x + pos.y + "attack",
                })
            );
            layer.add(tooltip);
            stage.add(layer);
        } else if (mode == "freeline") {
            freeLine = new Konva.Line({
                stroke: '#000',
                strokeWidth: 2,
                points: [pos.x, pos.y],
                id: pos.x + pos.y + "freeLine"
            });
            layer.add(freeLine);
            stage.add(layer);
            if (mode == "freeline") {
                stage.on('mousemove touchmove', function() {
                    if (!isPaint) {
                        return;
                    }
                    if (mode == "freeline") {
                        const pos = stage.getPointerPosition();
                        var newPoints = freeLine.points().concat([pos.x, pos.y]);
                        freeLine.points(newPoints);
                        layer.batchDraw();
                    }
                });
            }
            stage.on('mouseup touchend', function() {
                isPaint = false;
            });
        } else if (mode == "") {
            var imageObj = new Image();
            imageObj.src = 'yoda.jpg';
            // imageObj.onload = function () {
            var yoda = new Konva.Image({
                x: pos.x,
                y: pos.y,
                image: imageObj,
                src: 'yoda.jpg',
                draggable: true,
                id: pos.x + pos.y + "image",
                width: 106,
                height: 118,
            });
            // add the shape to the layer
            layer.add(yoda);
            layer.batchDraw();
            stage.add(layer);
            // };
        } else if (mode == "icon") {
            var color = "black";
            var path = new Konva.Path({
                x: pos.x,
                y: pos.y,
                data: iconData,
                id: pos.x + pos.y + "icon",
                draggable: true,
                fill: color,
            });
            layer.add(path);
            stage.add(layer);
        } else if (mode == "Dtext") {
            var textNode = new Konva.Text({
                text: 'Some text here',
                x: pos.x + 10,
                y: pos.y,
                fontSize: 20,
                id: pos.x + pos.y + "Text",
                fill: 'black',
                draggabl: true,
            });
            layer.add(textNode);
            stage.add(layer);
            var textPosition = textNode.getAbsolutePosition();
            var stageBox = stage.container().getBoundingClientRect();
            var areaPosition = {
                x: stageBox.left + textPosition.x,
                y: stageBox.top + textPosition.y,
            };
            var textarea = document.createElement('textarea');
            document.body.appendChild(textarea);
            textarea.value = textNode.text();
            textarea.style.position = 'absolute';
            textarea.style.top = areaPosition.y + 200 + 'px';
            textarea.style.left = areaPosition.x + 'px';
            textarea.style.width = textNode.width();
            //    textarea.focus();
            //    textNode.on('dblclick', () => {
            //    textarea.addEventListener('keydown', function (e) {
            //       if (e.keyCode === 13) {
            //             textNode.text(textarea.value);
            //           layer.draw();
            //            document.body.removeChild(textarea);
            //         }
            //    });
            // });
            $(textarea).on('blur', function(e) {
                textNode.text(textarea.value);
                layer.draw();
                document.body.removeChild(textarea);
            });
        }
    }
}
var icons = {
    "cone": "M9.59981 11.078C11.9898 11.078 13.9918 10.266 14.1128 9.205L12.9878 6.053C12.7238 6.814 11.2628 7.354 9.59981 7.354C7.93681 7.354 6.47581 6.814 6.21181 6.053L5.08781 9.205C5.20881 10.266 7.20981 11.078 9.59981 11.078V11.078ZM9.59981 4.373C10.7238 4.373 11.7668 4.025 12.0728 3.484C11.6518 2.302 11.2908 1.287 11.0618 0.648C10.9098 0.221 10.2208 0 9.59981 0C8.97881 0 8.28981 0.221 8.13781 0.648L7.12681 3.484C7.43281 4.025 8.47681 4.373 9.59981 4.373V4.373ZM18.3798 12.066L14.6248 10.552L15.0578 11.759C15.0358 13.038 12.5538 14.058 9.59981 14.058C6.64681 14.058 4.16281 13.039 4.14181 11.759L4.57481 10.552L0.819809 12.066C-0.233191 12.49 -0.278191 13.275 0.721809 13.81L7.78381 17.597C8.78181 18.132 10.4168 18.132 11.4158 17.597L18.4788 13.81C19.4778 13.275 19.4328 12.49 18.3798 12.066Z",
    "camera": 'M18.1481 2.61539H15L14.25 0.495055C14.1982 0.349967 14.1032 0.224554 13.9781 0.135948C13.853 0.0473417 13.7038 -0.000136051 13.5509 2.92836e-07H6.44907C6.13657 2.92836e-07 5.85648 0.198489 5.75231 0.495055L5 2.61539H1.85185C0.828704 2.61539 0 3.45137 0 4.48352V15.1319C0 16.164 0.828704 17 1.85185 17H18.1481C19.1713 17 20 16.164 20 15.1319V4.48352C20 3.45137 19.1713 2.61539 18.1481 2.61539ZM10 13.2637C7.9537 13.2637 6.2963 11.5918 6.2963 9.52747C6.2963 7.46319 7.9537 5.79121 10 5.79121C12.0463 5.79121 13.7037 7.46319 13.7037 9.52747C13.7037 11.5918 12.0463 13.2637 10 13.2637ZM7.77778 9.52747C7.77778 10.122 8.0119 10.6922 8.42865 11.1126C8.8454 11.533 9.41063 11.7692 10 11.7692C10.5894 11.7692 11.1546 11.533 11.5713 11.1126C11.9881 10.6922 12.2222 10.122 12.2222 9.52747C12.2222 8.93292 11.9881 8.36272 11.5713 7.94231C11.1546 7.5219 10.5894 7.28571 10 7.28571C9.41063 7.28571 8.8454 7.5219 8.42865 7.94231C8.0119 8.36272 7.77778 8.93292 7.77778 9.52747Z',
    "close_x": "M18.5625 3.1338L15.9909 0.5625L9.5625 6.9912L3.1338 0.5625L0.5625 3.1338L6.9909 9.5625L0.5625 15.9912L3.1338 18.5625L9.5625 12.1338L15.9909 18.5625L18.5625 15.9912L12.1335 9.5625L18.5625 3.1338Z",
    "hoop": 'M16.3636 0H1.63636C1.20237 0 0.786158 0.180612 0.47928 0.502103C0.172402 0.823594 0 1.25963 0 1.71429V12C0 12.4547 0.172402 12.8907 0.47928 13.2122C0.786158 13.5337 1.20237 13.7143 1.63636 13.7143H4.55727L5.72727 18L7.36364 16.2857L9 18L10.6364 16.2857L12.2727 18L13.4427 13.7143H16.3636C16.7976 13.7143 17.2138 13.5337 17.5207 13.2122C17.8276 12.8907 18 12.4547 18 12V1.71429C18 1.25963 17.8276 0.823594 17.5207 0.502103C17.2138 0.180612 16.7976 0 16.3636 0ZM16.3636 12H13.9091V10.2857H13.0909V6C13.0909 5.54534 12.9185 5.10931 12.6116 4.78782C12.3048 4.46633 11.8885 4.28571 11.4545 4.28571H6.54545C6.11146 4.28571 5.69525 4.46633 5.38837 4.78782C5.08149 5.10931 4.90909 5.54534 4.90909 6V10.2857H4.09091V12H1.63636V1.71429H16.3636V12ZM6.54545 10.2857V6H11.4545V10.2857H6.54545Z',
    "4_ball_track": 'M4.5 12.5C4.5 15.3834 4.33286 17.9837 4.06569 19.8539C3.93156 20.7928 3.77511 21.5265 3.61016 22.0149C3.5715 22.1293 3.53443 22.224 3.5 22.3009C3.46557 22.224 3.4285 22.1293 3.38984 22.0149C3.22489 21.5265 3.06844 20.7928 2.93431 19.8539C2.66714 17.9837 2.5 15.3834 2.5 12.5C2.5 9.61655 2.66714 7.0163 2.93431 5.14609C3.06844 4.20721 3.22489 3.47352 3.38984 2.98514C3.4285 2.87067 3.46557 2.77601 3.5 2.69909C3.53443 2.77601 3.5715 2.87067 3.61016 2.98514C3.77511 3.47352 3.93156 4.20721 4.06569 5.14609C4.33286 7.0163 4.5 9.61655 4.5 12.5ZM3.35559 22.5454C3.35558 22.5451 3.35749 22.5431 3.36139 22.54C3.35756 22.5441 3.35561 22.5456 3.35559 22.5454ZM3.6386 22.54C3.64251 22.5431 3.64442 22.5451 3.64441 22.5454C3.64439 22.5456 3.64244 22.5441 3.6386 22.54ZM3.64441 2.4546C3.64442 2.45485 3.6425 2.4569 3.63857 2.46001C3.64243 2.4559 3.64439 2.45435 3.64441 2.4546ZM3.36143 2.46001C3.3575 2.4569 3.35558 2.45485 3.35559 2.4546C3.35561 2.45435 3.35757 2.4559 3.36143 2.46001Z,M20.5 12.5C20.5 15.3834 20.3329 17.9837 20.0657 19.8539C19.9316 20.7928 19.7751 21.5265 19.6102 22.0149C19.5715 22.1293 19.5344 22.224 19.5 22.3009C19.4656 22.224 19.4285 22.1293 19.3898 22.0149C19.2249 21.5265 19.0684 20.7928 18.9343 19.8539C18.6671 17.9837 18.5 15.3834 18.5 12.5C18.5 9.61655 18.6671 7.0163 18.9343 5.14609C19.0684 4.20721 19.2249 3.47352 19.3898 2.98514C19.4285 2.87067 19.4656 2.77601 19.5 2.69909C19.5344 2.77601 19.5715 2.87067 19.6102 2.98514C19.7751 3.47352 19.9316 4.20721 20.0657 5.14609C20.3329 7.0163 20.5 9.61655 20.5 12.5ZM19.3556 22.5454C19.3556 22.5451 19.3575 22.5431 19.3614 22.54C19.3576 22.5441 19.3556 22.5456 19.3556 22.5454ZM19.6386 22.54C19.6425 22.5431 19.6444 22.5451 19.6444 22.5454C19.6444 22.5456 19.6424 22.5441 19.6386 22.54ZM19.6444 2.4546C19.6444 2.45485 19.6425 2.4569 19.6386 2.46001C19.6424 2.4559 19.6444 2.45435 19.6444 2.4546ZM19.3614 2.46001C19.3575 2.4569 19.3556 2.45485 19.3556 2.4546C19.3556 2.45435 19.3576 2.4559 19.3614 2.46001Z, M15.1875 15C14.7549 15 14.3319 15.1283 13.9722 15.3687C13.6125 15.609 13.3321 15.9507 13.1665 16.3504C13.0009 16.7501 12.9576 17.1899 13.042 17.6143C13.1264 18.0386 13.3348 18.4284 13.6407 18.7343C13.9466 19.0402 14.3364 19.2486 14.7607 19.333C15.1851 19.4174 15.6249 19.3741 16.0246 19.2085C16.4243 19.0429 16.766 18.7625 17.0063 18.4028C17.2467 18.0431 17.375 17.6201 17.375 17.1875C17.3743 16.6075 17.1437 16.0515 16.7336 15.6414C16.3235 15.2313 15.7675 15.0007 15.1875 15V15ZM17.0547 17.0312H16.1313C16.1704 16.6269 16.3182 16.2407 16.5591 15.9136C16.8451 16.2199 17.0197 16.6136 17.0547 17.0312ZM15.3438 17.0312V15.3203C15.701 15.3501 16.0421 15.4824 16.3261 15.7012C16.0337 16.0872 15.8577 16.5486 15.8188 17.0312H15.3438ZM15.0313 17.0312H14.5563C14.5173 16.5486 14.3413 16.0872 14.0489 15.7012C14.3329 15.4824 14.674 15.3502 15.0313 15.3205V17.0312ZM15.0313 17.3438V19.0547C14.674 19.0249 14.3329 18.8926 14.0489 18.6737C14.3413 18.2878 14.5173 17.8264 14.5563 17.3438H15.0313ZM15.3438 17.3438H15.8188C15.8578 17.8264 16.0338 18.2878 16.3263 18.6737C16.0422 18.8926 15.7011 19.0248 15.3438 19.0545V17.3438ZM13.8156 15.9136C14.0566 16.2407 14.2045 16.6269 14.2438 17.0312H13.3205C13.3554 16.6136 13.5298 16.2199 13.8158 15.9136H13.8156ZM13.3203 17.3438H14.2438C14.2046 17.7481 14.0568 18.1343 13.8159 18.4614C13.5299 18.1551 13.3553 17.7614 13.3203 17.3438V17.3438ZM16.5594 18.4614C16.3184 18.1343 16.1705 17.7481 16.1313 17.3438H17.0544C17.0195 17.7614 16.845 18.1551 16.5591 18.4614H16.5594Z,M8.1875 3C7.75485 3 7.33192 3.12829 6.97219 3.36866C6.61246 3.60903 6.33208 3.95067 6.16651 4.35038C6.00095 4.75009 5.95763 5.18993 6.04203 5.61426C6.12644 6.03859 6.33478 6.42837 6.6407 6.7343C6.94663 7.04022 7.33641 7.24856 7.76074 7.33297C8.18507 7.41737 8.62491 7.37405 9.02462 7.20849C9.42433 7.04292 9.76598 6.76254 10.0063 6.40281C10.2467 6.04308 10.375 5.62015 10.375 5.1875C10.3743 4.60754 10.1437 4.05153 9.73357 3.64143C9.32347 3.23134 8.76746 3.00066 8.1875 3V3ZM10.0547 5.03125H9.13125C9.17042 4.62693 9.31824 4.24073 9.55906 3.91359C9.84512 4.2199 10.0197 4.6136 10.0547 5.03125ZM8.34375 5.03125V3.32031C8.70104 3.35008 9.04215 3.48235 9.32609 3.70125C9.03374 4.0872 8.85772 4.54864 8.81875 5.03125H8.34375ZM8.03125 5.03125H7.55625C7.51728 4.54864 7.34126 4.0872 7.04891 3.70125C7.33287 3.48241 7.67398 3.35019 8.03125 3.32047V5.03125ZM8.03125 5.34375V7.05469C7.67396 7.02492 7.33286 6.89265 7.04891 6.67375C7.34126 6.2878 7.51728 5.82636 7.55625 5.34375H8.03125ZM8.34375 5.34375H8.81875C8.85776 5.82638 9.03384 6.28781 9.32625 6.67375C9.04224 6.89262 8.70108 7.02484 8.34375 7.05453V5.34375ZM6.81563 3.91359C7.05656 4.2407 7.20449 4.62689 7.24375 5.03125H6.32047C6.35536 4.61364 6.52984 4.21994 6.81578 3.91359H6.81563ZM6.32031 5.34375H7.24375C7.20459 5.74807 7.05676 6.13427 6.81594 6.46141C6.52988 6.1551 6.35529 5.7614 6.32031 5.34375V5.34375ZM9.55938 6.46141C9.31844 6.1343 9.17051 5.74811 9.13125 5.34375H10.0544C10.0195 5.76136 9.84501 6.15506 9.55906 6.46141H9.55938Z,M8.1875 15C7.75485 15 7.33192 15.1283 6.97219 15.3687C6.61246 15.609 6.33208 15.9507 6.16651 16.3504C6.00095 16.7501 5.95763 17.1899 6.04203 17.6143C6.12644 18.0386 6.33478 18.4284 6.6407 18.7343C6.94663 19.0402 7.33641 19.2486 7.76074 19.333C8.18507 19.4174 8.62491 19.3741 9.02462 19.2085C9.42433 19.0429 9.76598 18.7625 10.0063 18.4028C10.2467 18.0431 10.375 17.6201 10.375 17.1875C10.3743 16.6075 10.1437 16.0515 9.73357 15.6414C9.32347 15.2313 8.76746 15.0007 8.1875 15V15ZM10.0547 17.0312H9.13125C9.17042 16.6269 9.31824 16.2407 9.55906 15.9136C9.84512 16.2199 10.0197 16.6136 10.0547 17.0312ZM8.34375 17.0312V15.3203C8.70104 15.3501 9.04215 15.4824 9.32609 15.7012C9.03374 16.0872 8.85772 16.5486 8.81875 17.0312H8.34375ZM8.03125 17.0312H7.55625C7.51728 16.5486 7.34126 16.0872 7.04891 15.7012C7.33287 15.4824 7.67398 15.3502 8.03125 15.3205V17.0312ZM8.03125 17.3438V19.0547C7.67396 19.0249 7.33286 18.8926 7.04891 18.6737C7.34126 18.2878 7.51728 17.8264 7.55625 17.3438H8.03125ZM8.34375 17.3438H8.81875C8.85776 17.8264 9.03384 18.2878 9.32625 18.6737C9.04224 18.8926 8.70108 19.0248 8.34375 19.0545V17.3438ZM6.81563 15.9136C7.05656 16.2407 7.20449 16.6269 7.24375 17.0312H6.32047C6.35536 16.6136 6.52984 16.2199 6.81578 15.9136H6.81563ZM6.32031 17.3438H7.24375C7.20459 17.7481 7.05676 18.1343 6.81594 18.4614C6.52988 18.1551 6.35529 17.7614 6.32031 17.3438V17.3438ZM9.55938 18.4614C9.31844 18.1343 9.17051 17.7481 9.13125 17.3438H10.0544C10.0195 17.7614 9.84501 18.1551 9.55906 18.4614H9.55938Z,M15.1875 9C14.7549 9 14.3319 9.12829 13.9722 9.36866C13.6125 9.60903 13.3321 9.95067 13.1665 10.3504C13.0009 10.7501 12.9576 11.1899 13.042 11.6143C13.1264 12.0386 13.3348 12.4284 13.6407 12.7343C13.9466 13.0402 14.3364 13.2486 14.7607 13.333C15.1851 13.4174 15.6249 13.3741 16.0246 13.2085C16.4243 13.0429 16.766 12.7625 17.0063 12.4028C17.2467 12.0431 17.375 11.6201 17.375 11.1875C17.3743 10.6075 17.1437 10.0515 16.7336 9.64143C16.3235 9.23134 15.7675 9.00066 15.1875 9V9ZM17.0547 11.0312H16.1313C16.1704 10.6269 16.3182 10.2407 16.5591 9.91359C16.8451 10.2199 17.0197 10.6136 17.0547 11.0312ZM15.3438 11.0312V9.32031C15.701 9.35008 16.0421 9.48235 16.3261 9.70125C16.0337 10.0872 15.8577 10.5486 15.8188 11.0312H15.3438ZM15.0313 11.0312H14.5563C14.5173 10.5486 14.3413 10.0872 14.0489 9.70125C14.3329 9.48241 14.674 9.35019 15.0313 9.32047V11.0312ZM15.0313 11.3438V13.0547C14.674 13.0249 14.3329 12.8926 14.0489 12.6737C14.3413 12.2878 14.5173 11.8264 14.5563 11.3438H15.0313ZM15.3438 11.3438H15.8188C15.8578 11.8264 16.0338 12.2878 16.3263 12.6737C16.0422 12.8926 15.7011 13.0248 15.3438 13.0545V11.3438ZM13.8156 9.91359C14.0566 10.2407 14.2045 10.6269 14.2438 11.0312H13.3205C13.3554 10.6136 13.5298 10.2199 13.8158 9.91359H13.8156ZM13.3203 11.3438H14.2438C14.2046 11.7481 14.0568 12.1343 13.8159 12.4614C13.5299 12.1551 13.3553 11.7614 13.3203 11.3438V11.3438ZM16.5594 12.4614C16.3184 12.1343 16.1705 11.7481 16.1313 11.3438H17.0544C17.0195 11.7614 16.845 12.1551 16.5591 12.4614H16.5594Z,M8.1875 9C7.75485 9 7.33192 9.12829 6.97219 9.36866C6.61246 9.60903 6.33208 9.95067 6.16651 10.3504C6.00095 10.7501 5.95763 11.1899 6.04203 11.6143C6.12644 12.0386 6.33478 12.4284 6.6407 12.7343C6.94663 13.0402 7.33641 13.2486 7.76074 13.333C8.18507 13.4174 8.62491 13.3741 9.02462 13.2085C9.42433 13.0429 9.76598 12.7625 10.0063 12.4028C10.2467 12.0431 10.375 11.6201 10.375 11.1875C10.3743 10.6075 10.1437 10.0515 9.73357 9.64143C9.32347 9.23134 8.76746 9.00066 8.1875 9V9ZM10.0547 11.0312H9.13125C9.17042 10.6269 9.31824 10.2407 9.55906 9.91359C9.84512 10.2199 10.0197 10.6136 10.0547 11.0312ZM8.34375 11.0312V9.32031C8.70104 9.35008 9.04215 9.48235 9.32609 9.70125C9.03374 10.0872 8.85772 10.5486 8.81875 11.0312H8.34375ZM8.03125 11.0312H7.55625C7.51728 10.5486 7.34126 10.0872 7.04891 9.70125C7.33287 9.48241 7.67398 9.35019 8.03125 9.32047V11.0312ZM8.03125 11.3438V13.0547C7.67396 13.0249 7.33286 12.8926 7.04891 12.6737C7.34126 12.2878 7.51728 11.8264 7.55625 11.3438H8.03125ZM8.34375 11.3438H8.81875C8.85776 11.8264 9.03384 12.2878 9.32625 12.6737C9.04224 12.8926 8.70108 13.0248 8.34375 13.0545V11.3438ZM6.81563 9.91359C7.05656 10.2407 7.20449 10.6269 7.24375 11.0312H6.32047C6.35536 10.6136 6.52984 10.2199 6.81578 9.91359H6.81563ZM6.32031 11.3438H7.24375C7.20459 11.7481 7.05676 12.1343 6.81594 12.4614C6.52988 12.1551 6.35529 11.7614 6.32031 11.3438V11.3438ZM9.55938 12.4614C9.31844 12.1343 9.17051 11.7481 9.13125 11.3438H10.0544C10.0195 11.7614 9.84501 12.1551 9.55906 12.4614H9.55938Zss',
    "copyright": 'M12 22C17.421 22 22 17.421 22 12C22 6.579 17.421 2 12 2C6.579 2 2 6.579 2 12C2 17.421 6.579 22 12 22ZM12 4C16.337 4 20 7.663 20 12C20 16.337 16.337 20 12 20C7.663 20 4 16.337 4 12C4 7.663 7.663 4 12 4Z,M12 17C12.901 17 14.581 16.832 15.707 15.708L14.293 14.292C13.85 14.735 12.992 15 12 15C10.374 15 9 13.626 9 12C9 10.374 10.374 9 12 9C12.993 9 13.851 9.265 14.293 9.707L15.707 8.293C14.582 7.168 12.901 7 12 7C9.243 7 7 9.243 7 12C7 14.757 9.243 17 12 17Z',
    "v_ball": 'M14.3875 3.6125C16.8113 7.14 15.9158 11.963 12.3875 14.3875C8.86 16.8112 4.037 15.9155 1.6125 12.3875C-0.811 8.86 0.0847502 4.0345 3.6125 1.6125C7.14 -0.8105 11.9655 0.0852501 14.3875 3.6125,M11.331 14.9965C11.331 14.9965 7.631 6.7515 11.5728 1.121L11.903 1.3035C11.903 1.3035 7.77375 6.96 12.1153 14.573L11.331 14.9955,M1.6115 12.3872C1.6115 12.3872 5.25825 6.97225 4.25225 1.216L3.80375 1.5245C3.80375 1.5245 5.7725 3.13125 1.3305 11.978,M8.63975 0.28525C8.63975 0.28525 4.131 5.93175 5.05725 15.1853C5.05725 15.1853 5.72725 15.384 5.9435 15.4607C6.15925 15.537 4.505 7.07825 9.3195 0.36325L8.6395 0.285,M0.42 6.7435C0.42 6.7435 6.28075 10.971 15.4785 9.59325C15.4785 9.59325 15.644 8.91425 15.7098 8.69475C15.7758 8.475 7.408 10.5417 0.46425 6.061L0.41925 6.7435'
};
$(document).on('click', '.tool-box-close', function() {
    $('.toolbox-container').addClass("toolbox_close");
    $('.open-close-button').empty();
    $('.open-close-button').append('<span class="tool-box-open">&gt;</span>');
});
$(document).on('click', '.tool-box-open', function() {
    $('.toolbox-container').removeClass("toolbox_close");
    $('.open-close-button').empty();
    $('.open-close-button').append('<span class="tool-box-close">&lt;</span>');
});