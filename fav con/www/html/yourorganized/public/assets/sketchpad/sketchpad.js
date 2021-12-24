$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.font-selection').select2();
    $('.dd-container').addClass('lines-option mr-25');
});
var colorSelected = "black";
var selectedground = "basketball_court_one";
$("#rink").val(1);
var DtextCount = 1;
var textarea;
var arrowstatus;
var Tsize = 15;
var mins;
var selecteShape;
var alignment = "left";
var sketchpadData;
//selectedground = sessionStorage.getItem("selectedground");
var url =  window.location.href;
var array = url.split('/');
var lastsegment = array[array.length-1];
var selectedSport;
if(lastsegment != "drills" || lastsegment != "drills#") {
    selectedSport = sessionStorage.getItem("selectedSport");
}
var json = $("#exampleFormControlTextarea1").val();
if(json.length == 0 ) {
}
else {
    open();
}
var myHistory = [];
myHistory[1] = 1;
var historyIndex = 0;
var width = 700;
var height = 400;
if(json.length == 0) {
    var stage = new Konva.Stage({
        container: 'play-ground',
        width: width,
        height: height,
    });
}
var courtlayer = new Konva.Layer();
function courtDisplay() {
    if(json.length == 0) {
        Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
            courtlayer.add(imageNode);
            imageNode.setAttrs({
                width: 700,
                height: 400,
            });
            courtlayer.batchDraw();
            stage.add(courtlayer);
        });
    }
}
var mode;
var attacktype;
$(".toolbox-container ul li").on("click", function(e) {
    colorSelected = 'black';
    $('.color-indicator').css('background-color',colorSelected);
    $('.color-indicator').css('border-color',colorSelected);
    $(".attacklistselection").removeClass('selectedTool');
    if(textarea == "undefined") {
    }
    else {
       $(textarea).css('display','none');
    }
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
    if( mode != "Freelinewitharrow" || mode != "arrow") {
        $(".lines-option").css('display','none');
    }
    if( mode == "Freelinewitharrow" || mode == "arrow") {
        $(".lines-option").css('display','block');
        $('#arrowoption').css('display','none');
    }
    if( mode != "delete" || mode != "undo" || mode != "redo") {
        $('.color-picker').css('display','block');
    }
    if( mode == "delete" || mode == "undo" || mode == "redo") {
        $('.color-picker').css('display','none');
    }
    if( mode == "Dtext") {
        $('.fontcontainer').css('display','block');
        $('.text-alignment').css('display','block');
    }
    if( mode != "Dtext") {
        $('.fontcontainer').css('display','none');
        $('.text-alignment').css('display','none');
    }
    if( attacktype == "PG") {
        $('.pg').css('display','block');
    }
    if( attacktype != "PG") {
        $('.pg').css('display','none');
    }
    if( attacktype == "SG") {
        $('.sg').css('display','block');
    }
    if( attacktype != "SG") {
        $('.sg').css('display','none');
    }
    if( attacktype == "PF") {
        $('.pf').css('display','block');
    }
    if( attacktype != "PF") {
        $('.pf').css('display','none');
    }
    if( attacktype == "SF") {
        $('.sf').css('display','block');
    }
    if( attacktype != "SF") {
        $('.sf').css('display','none');
    }
    if( attacktype == "C") {
        $('.c').css('display','block');
    }
    if( attacktype != "C") {
        $('.c').css('display','none');
    }
});
stage.on('mousedown touchstart', function(e) {
    drawShapes(e);
    $("#undo").removeClass('disableclick');
    sketchpadData = stage.toJSON();
    $("#exampleFormControlTextarea1").val(sketchpadData)
})
stage.on('mouseup touchend', function() {
    isPaint = false;
    if ( mode == "Freelinewitharrow")  {
        historyIndex += 1;
        myHistory.push(stage.toJSON());
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
        if( historyIndex > 1) {
        $("#undo").removeClass('disableclick');
        }
    }
    else {
        isPaint = false;
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
    }
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
        if( lastsegment == "drills" || lastsegment == "drills#")  {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: 700,
                        height: 400,
                });
                undogroundlayer.batchDraw();
                stage.add(undogroundlayer);
                undogroundlayer.zIndex(0);
                $("#exampleFormControlTextarea1").val('');
                sketchpadData = stage.toJSON();
                $("#exampleFormControlTextarea1").val(sketchpadData)
            });
        }
        else {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('../assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: 700,
                        height: 400,
                });
                undogroundlayer.batchDraw();
                stage.add(undogroundlayer);
                undogroundlayer.zIndex(0);
                $("#exampleFormControlTextarea1").val('');
                sketchpadData = stage.toJSON();
                $("#exampleFormControlTextarea1").val(sketchpadData)
            });
        }
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
    var undogroundlayer = new Konva.Layer();
    if( lastsegment == "drills" || lastsegment == "drills#")  {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: 700,
                        height: 400,
                });
                undogroundlayer.batchDraw();
                stage.add(undogroundlayer);
                undogroundlayer.zIndex(0);
                $("#exampleFormControlTextarea1").val('');
                sketchpadData = stage.toJSON();
                $("#exampleFormControlTextarea1").val(sketchpadData)
            });
        }
        else {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('../assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: 700,
                        height: 400,
                });
                undogroundlayer.batchDraw();
                stage.add(undogroundlayer);
                undogroundlayer.zIndex(0);
                $("#exampleFormControlTextarea1").val('');
                sketchpadData = stage.toJSON();
                $("#exampleFormControlTextarea1").val(sketchpadData)
            });
        }
    isPaint = true;
    if (myHistory.length - 1 == historyIndex) {
        $("#redo").addClass("disableclick");
    }
    stage.on('mousedown touchstart', function(e) {
        drawShapes(e);
    });
}
function open() {
    stage = Konva.Node.create(json, 'play-ground');
    var undogroundlayer = new Konva.Layer();
        Konva.Image.fromURL('../assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
            undogroundlayer.add(imageNode);
                imageNode.setAttrs({
                    width: 700,
                    height: 400,
            });
            undogroundlayer.batchDraw();
            stage.add(undogroundlayer);
            undogroundlayer.zIndex(0);
            //$("canvas").gt(3).remove();
        });
    stage.on('mousedown touchstart', function(e) {
        // drawShapes(e);
    });
}
function drawShapes(e) {
    var layer = new Konva.Layer();
    var iconData = icons[attacktype];
    var stage = e.currentTarget;
    if (stage.attrs.container.id == "play-ground") {
        isPaint = true;
        var pos = stage.getPointerPosition();
        $('.konvajs-content').css('cursor', 'pointer');
        if( mode == "Select") {
            selecteShape = e.target.attrs;
            console.log(e);
            $('.color-indicator').css('background-color',e.target.attrs.stroke);
            $('.color-indicator').css('border-color',e.target.attrs.stroke);
        }
        if (mode == 'delete') {
            var shapeid = e.target.attrs.id || e.currentTarget.clickEndShape.attrs.id || e.currentTarget.children[0].children[0].attrs.id;
            var shape = stage.find('#' + shapeid);
            shape.hide();
            layer.draw();
            stage.add(layer);
        }
        if (mode == "wiggleline") {
            var i = 1;
            var last_x;
            function buildAnchor(x, y) {
                if (mode == "wiggleline") {
                    var anchor = new Konva.Path({
                        x: x,
                        y: y,
                        data:'M14.5 18C11.5 18 10.31 13.76 9.05 9.28C8.14 6.04 7 2 5.5 2C2.11 2 2 8.93 2 9H0C0 8.63 0.0599999 0 5.5 0C8.5 0 9.71 4.25 10.97 8.74C11.83 11.8 13 16 14.5 16C17.94 16 18.03 9.07 18.03 9H20.03C20.03 9.37 19.97 18 14.5 18Z',
                        fill: colorSelected,
                        strokeWidth: 0,
                        draggable: true,
                        id: pos.x + pos.y + "streightline"
                    });
                    layer.add(anchor);
                    anchor.on('dragmove', function() {
                        updateDottedLines();
                    });
                    return anchor;
                }
            }
            var k = 1;
            var bezier = {
                start: buildAnchor(pos.x, pos.y),
            };
            if (mode == "wiggleline") {
                streightline = new Konva.Line({
                    stroke: colorSelected,
                    strokeWidth: 0,
                    tension: 1,
                    id: pos.x + pos.y + "wiggleline",
                    closed: true,
                    draggable: true
                });
            }
            layer.add(streightline);
            stage.add(layer);
            if (mode == "wiggleline") {
                stage.on('mousemove touchmove', function() {
                    if (!isPaint) {
                        return;
                    }
                    if (mode == "wiggleline") {
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
                            last_x = newpos.x + 17;
                            var endbezier = {
                                end: buildAnchor(newpos.x, newpos.y),
                            };
                            var b = bezier;
                            var c = endbezier;
                        }
                        layer.draw();
                    }
                });
            }
            stage.on('mouseup touchend', function() {
                isPaint = false;
            });
        }
        if (mode == "arrow") {
            function buildAnchor(x, y) {
                if (mode == "arrow") {
                    var anchor = new Konva.Circle({
                        x: x,
                        y: y,
                        radius: 0,
                        stroke: colorSelected,
                        fill: colorSelected,
                        strokeWidth: 0,
                        draggable: true,
                        id: pos.x + pos.y + "Arrow",
                    });
                    layer.add(anchor);
                    return anchor;
                }
            }
            var bezier = {
                start: buildAnchor(pos.x, pos.y),
            };
            if (mode == "arrow") {
                lineArrow = new Konva.Arrow({
                    stroke: colorSelected,
                    fill: colorSelected,
                    strokeWidth: 1,
                    draggable: true,
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
            function buildAnchor(x, y) {
                if (mode == "streightline") {
                    var anchor = new Konva.Circle({
                        x: x,
                        y: y,
                        radius: 0,
                        stroke: colorSelected,
                        fill: colorSelected,
                        strokeWidth: 0,
                        draggable: true,
                        id: pos.x + pos.y + "streightline"
                    });
                    layer.add(anchor);
                    return anchor;
                }
            }
            var bezier = {
                start: buildAnchor(pos.x, pos.y),
            };
            if (mode == "streightline") {
                streightline = new Konva.Line({
                    stroke: colorSelected,
                    strokeWidth: 1,
                    tension: 1,
                    draggable: true,
                    id: pos.x + pos.y + "line",
                    draggable: true
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
                        var endbezier = {
                            end: buildAnchor(newpos.x, newpos.y),
                        };
                        var b = bezier;
                        var c = endbezier;
                        streightline.points([
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
        if (mode == "circ") {
            var circle = new Konva.Circle({
                x: pos.x,
                y: pos.y,
                fill: 'white',
                stroke: colorSelected,
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
                stroke: colorSelected,
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
                stroke: colorSelected,
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
                    fill: colorSelected,
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
                stroke: colorSelected,
                strokeWidth: 2,
                points: [pos.x, pos.y],
                id: pos.x + pos.y + "freeLine",
                draggable: true
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
        }
         else if (mode == "Freelinewitharrow") {
            freeLine = new Konva.Arrow({
                stroke: colorSelected,
                fill: colorSelected,
                strokeWidth: 2,
                points: [pos.x, pos.y],
                id: pos.x + pos.y + "Freelinewitharrow",
                draggable: true
            });
            layer.add(freeLine);
            stage.add(layer);
            if (mode == "Freelinewitharrow") {
                stage.on('mousemove touchmove', function() {
                    if (!isPaint) {
                        return;
                    }
                    if (mode == "Freelinewitharrow") {
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
        } else if (mode == "icon") {
            var path = new Konva.Path({
                x: pos.x,
                y: pos.y,
                data: iconData,
                id: pos.x + pos.y + "icon",
                draggable: true,
                fill: colorSelected,
            });
            layer.add(path);
            stage.add(layer);
        } else if (mode == "Dtext") {
            if( DtextCount % 2 == 1 ) {
                var textNode = new Konva.Text({
                    text: ' ',
                    x: pos.x + 10,
                    y: pos.y,
                    fontSize: Tsize,
                    id: pos.x + pos.y + "Text",
                    fill: colorSelected,
                    draggable: true,
                });
                layer.add(textNode);
                stage.add(layer);
                var textPosition = textNode.getAbsolutePosition();
                var stageBox = stage.container().getBoundingClientRect();
                var areaPosition = {
                    x: stageBox.left + textPosition.x,
                    y: stageBox.top + textPosition.y,
                };
                textarea   = document.createElement('textarea');
                textarea.style.width = '150px';
                textarea.style.height = '60px';
                 textarea.style.color = colorSelected;
                textarea.style.fontSize = Tsize+'px';
                textarea.style.align = "right";
                 textarea.style.zIndex = 999;
                textarea.autofocus = true;
                document.body.appendChild(textarea);
                textarea.value = textNode.text();
                textarea.style.position = 'absolute';
                textarea.style.textAlign = alignment;
                textarea.style.top = areaPosition.y + 15 + 'px';
                textarea.style.left = areaPosition.x + 'px';
                textarea.style.width = textNode.width();
                $(textarea).on('focus', function(e) {
                    textarea.value.fontSize = Tsize+'px';
                });
                $(textarea).on('blur', function(e) {
                    textarea.style.top = areaPosition.y - 40 + 'px';
                    textNode.text(textarea.value);
                    layer.draw();
                });
            }
            else {
                if( DtextCount  == 2 ) {
                    document.body.removeChild(textarea);
                }
                else if( DtextCount % 2 == 0 ) {
                    document.body.removeChild(textarea);
                }

            }
            DtextCount = DtextCount+1;
        }
    }
    if ( mode != "Freelinewitharrow")  {
        historyIndex += 1;
        myHistory.push(stage.toJSON());
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
        if( historyIndex > 1) {
        $("#undo").removeClass('disableclick');
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
    "v_ball": 'M14.3875 3.6125C16.8113 7.14 15.9158 11.963 12.3875 14.3875C8.86 16.8112 4.037 15.9155 1.6125 12.3875C-0.811 8.86 0.0847502 4.0345 3.6125 1.6125C7.14 -0.8105 11.9655 0.0852501 14.3875 3.6125,M11.331 14.9965C11.331 14.9965 7.631 6.7515 11.5728 1.121L11.903 1.3035C11.903 1.3035 7.77375 6.96 12.1153 14.573L11.331 14.9955,M1.6115 12.3872C1.6115 12.3872 5.25825 6.97225 4.25225 1.216L3.80375 1.5245C3.80375 1.5245 5.7725 3.13125 1.3305 11.978,M8.63975 0.28525C8.63975 0.28525 4.131 5.93175 5.05725 15.1853C5.05725 15.1853 5.72725 15.384 5.9435 15.4607C6.15925 15.537 4.505 7.07825 9.3195 0.36325L8.6395 0.285,M0.42 6.7435C0.42 6.7435 6.28075 10.971 15.4785 9.59325C15.4785 9.59325 15.644 8.91425 15.7098 8.69475C15.7758 8.475 7.408 10.5417 0.46425 6.061L0.41925 6.7435',
    "rebound":'M3.92501 2.93896C4.46349 2.93896 4.90001 2.50491 4.90001 1.96948C4.90001 1.43405 4.46349 1 3.92501 1C3.38653 1 2.95001 1.43405 2.95001 1.96948C2.95001 2.50491 3.38653 2.93896 3.92501 2.93896Z,M1 11.9551L1.26 5.8474C1.2925 4.94255 2.04 4.2316 2.95 4.2316H4.9C5.81 4.2316 6.5575 4.94255 6.59 5.8474C6.59 5.8474 6.6225 8.01257 6.6875 8.85278C6.8175 10.4363 7.5 11.9551 7.5 11.9551,M5.54998 6.17056C4.76998 7.30162 5.32248 8.14184 5.54998 8.75584C5.71248 9.17595 5.80998 10.1131 5.84248 10.5655C6.03748 12.5045 6.16748 18.386 6.16748 18.386C6.19998 18.7415 5.93998 18.9677 5.67998 18.9677C5.41998 18.9677 5.22498 18.7738 5.19248 18.5476L4.31498 11.018C4.28248 10.8241 4.15248 10.6625 3.92498 10.6625C3.69748 10.6625 3.56748 10.8241 3.53498 11.018L2.65748 18.5476C2.62498 18.7738 2.42998 18.9677 2.16998 18.9677C1.90998 18.9677 1.64998 18.7415 1.68248 18.386C1.68248 18.386 1.84498 12.5368 2.03998 10.6302C2.07248 10.1454 2.16998 9.20826 2.29998 8.72352C2.49498 8.10952 3.07998 7.20467 2.29998 6.13824,M11.075 2.93896C11.6135 2.93896 12.05 2.50491 12.05 1.96948C12.05 1.43405 11.6135 1 11.075 1C10.5365 1 10.1 1.43405 10.1 1.96948C10.1 2.50491 10.5365 2.93896 11.075 2.93896Z,M7.5 11.9551C7.5 11.9551 8.1825 10.4363 8.3125 8.85278C8.3775 8.04488 8.41 5.8474 8.41 5.8474C8.4425 4.94255 9.19 4.2316 10.1 4.2316H12.05C12.96 4.2316 13.7075 4.94255 13.74 5.8474L14 11.9551,M12.7 6.17056C11.92 7.23698 12.505 8.14183 12.7 8.75583C12.8625 9.20826 12.9275 10.1777 12.96 10.6625C13.155 12.5691 13.3175 18.4183 13.3175 18.4183C13.35 18.7738 13.09 19 12.83 19C12.57 19 12.375 18.8061 12.3425 18.5799L11.465 11.0503C11.4325 10.8564 11.3025 10.6948 11.075 10.6948C10.8475 10.6948 10.7175 10.8564 10.685 11.0503L9.8075 18.5799C9.775 18.8061 9.58 19 9.32 19C9.06 19 8.8 18.7738 8.8325 18.4183C8.8325 18.4183 8.9625 12.5368 9.1575 10.5978C9.19 10.1454 9.2875 9.20826 9.45 8.78815C9.645 8.17415 10.1975 7.33393 9.45 6.20287,M4.30252 12.0388C4.29377 12.0388 4.28502 12.0375 4.27627 12.0363C4.19627 12.0213 4.14377 11.9413 4.15752 11.8575C4.79252 8.15251 6.02627 5.88251 6.03877 5.86001C6.04788 5.8427 6.06043 5.82743 6.07565 5.81514C6.09087 5.80285 6.10844 5.79379 6.12728 5.78852C6.14612 5.78326 6.16583 5.78189 6.18522 5.78451C6.20461 5.78713 6.22325 5.79368 6.24002 5.80376C6.31002 5.84626 6.33502 5.94126 6.29377 6.01501C6.28127 6.03626 5.07252 8.26501 4.44752 11.9125C4.43377 11.9863 4.37127 12.0388 4.30252 12.0388Z,M5.88251 12.0388C5.87376 12.0388 5.86501 12.0375 5.85626 12.0363C5.77626 12.0213 5.72376 11.9413 5.73751 11.8575C6.37251 8.15251 7.60626 5.88251 7.61876 5.86001C7.62787 5.8427 7.64042 5.82743 7.65564 5.81514C7.67086 5.80285 7.68842 5.79379 7.70726 5.78852C7.7261 5.78326 7.74582 5.78189 7.76521 5.78451C7.78459 5.78713 7.80324 5.79368 7.82001 5.80376C7.89001 5.84626 7.91501 5.94126 7.87376 6.01501C7.86126 6.03626 6.65251 8.26501 6.02751 11.9125C6.01501 11.9863 5.95251 12.0388 5.88251 12.0388Z,M7.42126 12.0388C7.41251 12.0388 7.40376 12.0375 7.39501 12.0363C7.31501 12.0213 7.26126 11.9413 7.27626 11.8575C7.91126 8.15375 9.08501 5.885 9.09751 5.8625C9.13626 5.7875 9.22626 5.76 9.29751 5.80125C9.36876 5.8425 9.39501 5.93625 9.35626 6.01125C9.34501 6.03375 8.19251 8.2625 7.56751 11.9125C7.55251 11.9863 7.49001 12.0388 7.42126 12.0388V12.0388Z,',
    "volleynet":'M5.82626 12.0388C5.75626 12.0388 5.69501 11.9863 5.68126 11.9113C5.05626 8.26376 3.84751 6.03501 3.83501 6.01376C3.79501 5.94001 3.81876 5.84501 3.88876 5.80251C3.95876 5.76001 4.04877 5.78501 4.09002 5.85876C4.10252 5.88126 5.33626 8.15126 5.97126 11.8563C5.98501 11.94 5.93251 12.02 5.85251 12.035C5.84376 12.0388 5.83501 12.0388 5.82626 12.0388V12.0388Z,M7.42001 12.0388C7.35001 12.0388 7.28876 11.9863 7.27501 11.9113C6.65001 8.26376 5.44126 6.03501 5.42876 6.01376C5.38876 5.94001 5.41251 5.84501 5.48251 5.80251C5.55251 5.76001 5.64252 5.78501 5.68377 5.85876C5.69627 5.88126 6.93001 8.15126 7.56501 11.8563C7.57876 11.94 7.52626 12.02 7.44626 12.035C7.43751 12.0388 7.42876 12.0388 7.42001 12.0388V12.0388Z,M8.88126 12.0388C8.81126 12.0388 8.74876 11.9863 8.73626 11.9113C8.11126 8.26376 6.90251 6.03501 6.89001 6.01376C6.85001 5.94001 6.87376 5.84501 6.94376 5.80251C7.01376 5.76001 7.10376 5.78501 7.14501 5.85876C7.15751 5.88126 8.39126 8.15126 9.02501 11.8563C9.04001 11.94 8.98626 12.02 8.90626 12.035C8.89876 12.0388 8.88876 12.0388 8.88126 12.0388V12.0388Z,M2.82876 12.0388C2.82001 12.0388 2.81126 12.0375 2.80251 12.0363C2.72251 12.0213 2.66876 11.9413 2.68376 11.8575C3.31876 8.15251 4.55251 5.88251 4.56501 5.86001C4.60501 5.78626 4.69501 5.76126 4.76626 5.80376C4.83626 5.84626 4.86001 5.94126 4.82001 6.01501C4.80751 6.03626 3.59876 8.26501 2.97376 11.9125C2.96126 11.9863 2.89876 12.0388 2.82876 12.0388V12.0388Z,M8.88126 12.0388C8.87251 12.0388 8.86376 12.0375 8.85501 12.0363C8.77501 12.0213 8.72126 11.9413 8.73626 11.8575C9.37126 8.15251 10.605 5.88251 10.6175 5.86001C10.6588 5.78626 10.7488 5.76126 10.8188 5.80376C10.8888 5.84626 10.9125 5.94126 10.8725 6.01501C10.86 6.03626 9.65126 8.26501 9.02626 11.9125C9.01251 11.9863 8.95001 12.0388 8.88126 12.0388V12.0388Z,M10.3975 12.0388C10.3888 12.0388 10.38 12.0375 10.3713 12.0363C10.2913 12.0213 10.2375 11.9413 10.2525 11.8575C10.8875 8.15251 12.1213 5.88251 12.1338 5.86001C12.175 5.78626 12.2638 5.76126 12.335 5.80376C12.405 5.84626 12.4288 5.94126 12.3888 6.01501C12.3763 6.03626 11.1675 8.26501 10.5425 11.9125C10.5288 11.9863 10.4663 12.0388 10.3975 12.0388V12.0388Z,M11.9138 12.0388C11.905 12.0388 11.8963 12.0375 11.8875 12.0363C11.8075 12.0213 11.7538 11.9413 11.7688 11.8575C12.205 9.31126 12.9213 7.45126 13.31 6.57001C13.345 6.49251 13.4313 6.45876 13.505 6.49501C13.5788 6.53126 13.6113 6.62251 13.5775 6.70001C13.195 7.56876 12.4888 9.40001 12.0588 11.9125C12.045 11.9863 11.9838 12.0388 11.9138 12.0388V12.0388Z,M10.3963 12.0388C10.3263 12.0388 10.2638 11.9863 10.2513 11.9113C9.62626 8.26376 8.41751 6.03501 8.40501 6.01376C8.36501 5.94001 8.38876 5.84501 8.45876 5.80251C8.52876 5.76001 8.61876 5.78501 8.66001 5.85876C8.67251 5.88126 9.90626 8.15126 10.5413 11.8563C10.5563 11.94 10.5025 12.02 10.4225 12.035C10.4138 12.0388 10.405 12.0388 10.3963 12.0388V12.0388Z,M11.9138 12.0388C11.8438 12.0388 11.7813 11.9863 11.7688 11.9113C11.1438 8.26376 9.93501 6.03501 9.92251 6.01376C9.88251 5.94001 9.90626 5.84501 9.97626 5.80251C10.0463 5.76001 10.1363 5.78501 10.1775 5.85876C10.19 5.88126 11.4238 8.15126 12.0588 11.8563C12.0738 11.94 12.02 12.02 11.94 12.035C11.9313 12.0388 11.9225 12.0388 11.9138 12.0388V12.0388Z,M13.3775 12.0388C13.3075 12.0388 13.245 11.9863 13.2325 11.9113C12.6075 8.26376 11.3988 6.03501 11.3863 6.01376C11.345 5.94001 11.37 5.84501 11.44 5.80251C11.51 5.76001 11.6 5.78501 11.6413 5.85876C11.6538 5.88126 12.8875 8.15126 13.5225 11.8563C13.5375 11.94 13.4838 12.02 13.4038 12.035C13.395 12.0388 13.3863 12.0388 13.3775 12.0388V12.0388Z,M4.30127 12.0388C4.23127 12.0388 4.17002 11.9863 4.15627 11.9113C3.53127 8.26376 2.32252 6.03501 2.31002 6.01376C2.27002 5.94001 2.29377 5.84501 2.36377 5.80251C2.43377 5.76001 2.52377 5.78501 2.56502 5.85876C2.57752 5.88126 3.81127 8.15126 4.44627 11.8563C4.46002 11.94 4.40752 12.02 4.32752 12.035C4.31877 12.0388 4.31002 12.0388 4.30127 12.0388V12.0388Z,M2.82875 12.2188C2.75875 12.2188 2.6975 12.1663 2.68375 12.0913C2.42875 10.605 2.0525 9.18376 1.56375 7.86751C1.535 7.78876 1.5725 7.69876 1.6475 7.66751C1.72375 7.63626 1.80875 7.67626 1.8375 7.75501C2.3325 9.09001 2.71375 10.53 2.9725 12.0363C2.9875 12.12 2.93375 12.2 2.85375 12.215C2.84625 12.2175 2.8375 12.2188 2.82875 12.2188V12.2188Z,M13.3788 12.2188C13.37 12.2188 13.3613 12.2175 13.3525 12.2163C13.2725 12.2013 13.22 12.1213 13.2338 12.0375C13.4925 10.5313 13.8738 9.09125 14.3688 7.75625C14.3988 7.67625 14.4838 7.6375 14.5588 7.66875C14.635 7.7 14.6725 7.78875 14.6425 7.86875C14.155 9.185 13.7775 10.6063 13.5238 12.0925C13.51 12.1663 13.4488 12.2188 13.3788 12.2188Z,M15.0175 13.0963C14.9913 13.0963 14.965 13.0938 14.9375 13.0875C8.44251 11.65 1.15126 13.075 1.07751 13.0888C0.878758 13.1288 0.685008 13 0.645008 12.8C0.605008 12.6 0.733758 12.4075 0.933758 12.3675C1.00751 12.3525 8.45251 10.8975 15.0963 12.3688C15.295 12.4125 15.42 12.6088 15.375 12.8075C15.3574 12.8893 15.3124 12.9625 15.2473 13.0151C15.1823 13.0676 15.1011 13.0963 15.0175 13.0963V13.0963Z,M15.22 13.915C14.6525 13.9188 14.6525 13.8238 14.4988 13.3175L13.185 6.47001V6.40001C13.185 6.14126 12.7613 5.83501 12.4038 5.83501H3.61876C3.26126 5.83501 2.83751 6.14126 2.83751 6.40001V6.47001L1.52501 13.3188C1.43501 13.9475 1.43501 13.9475 0.66376 13.9025C0.25876 13.8788 -0.18374 13.9163 0.0800102 13.0413L1.36876 6.32251C1.76626 4.36626 2.57751 4.36626 3.62001 4.36626H12.405C13.4475 4.36626 14.2163 4.36626 14.6563 6.32251L15.945 13.0413C16.1113 13.92 15.9075 13.9338 15.3613 13.92C15.3113 13.9188 15.2663 13.915 15.22 13.915V13.915Z',
    "volley4ballrack":'M4.5 11.5C4.5 14.3834 4.33286 16.9837 4.06569 18.8539C3.93156 19.7928 3.77511 20.5265 3.61016 21.0149C3.5715 21.1293 3.53443 21.224 3.5 21.3009C3.46557 21.224 3.4285 21.1293 3.38984 21.0149C3.22489 20.5265 3.06844 19.7928 2.93431 18.8539C2.66714 16.9837 2.5 14.3834 2.5 11.5C2.5 8.61655 2.66714 6.0163 2.93431 4.14609C3.06844 3.20721 3.22489 2.47352 3.38984 1.98514C3.4285 1.87067 3.46557 1.77601 3.5 1.69909C3.53443 1.77601 3.5715 1.87067 3.61016 1.98514C3.77511 2.47352 3.93156 3.20721 4.06569 4.14609C4.33286 6.0163 4.5 8.61655 4.5 11.5ZM3.35559 21.5454C3.35558 21.5451 3.35749 21.5431 3.36139 21.54C3.35756 21.5441 3.35561 21.5456 3.35559 21.5454ZM3.6386 21.54C3.64251 21.5431 3.64442 21.5451 3.64441 21.5454C3.64439 21.5456 3.64244 21.5441 3.6386 21.54ZM3.64441 1.4546C3.64442 1.45485 3.6425 1.4569 3.63857 1.46001C3.64243 1.4559 3.64439 1.45435 3.64441 1.4546ZM3.36143 1.46001C3.3575 1.4569 3.35558 1.45485 3.35559 1.4546C3.35561 1.45435 3.35757 1.4559 3.36143 1.46001Z,M20.5 11.5C20.5 14.3834 20.3329 16.9837 20.0657 18.8539C19.9316 19.7928 19.7751 20.5265 19.6102 21.0149C19.5715 21.1293 19.5344 21.224 19.5 21.3009C19.4656 21.224 19.4285 21.1293 19.3898 21.0149C19.2249 20.5265 19.0684 19.7928 18.9343 18.8539C18.6671 16.9837 18.5 14.3834 18.5 11.5C18.5 8.61655 18.6671 6.0163 18.9343 4.14609C19.0684 3.20721 19.2249 2.47352 19.3898 1.98514C19.4285 1.87067 19.4656 1.77601 19.5 1.69909C19.5344 1.77601 19.5715 1.87067 19.6102 1.98514C19.7751 2.47352 19.9316 3.20721 20.0657 4.14609C20.3329 6.0163 20.5 8.61655 20.5 11.5ZM19.3556 21.5454C19.3556 21.5451 19.3575 21.5431 19.3614 21.54C19.3576 21.5441 19.3556 21.5456 19.3556 21.5454ZM19.6386 21.54C19.6425 21.5431 19.6444 21.5451 19.6444 21.5454C19.6444 21.5456 19.6424 21.5441 19.6386 21.54ZM19.6444 1.4546C19.6444 1.45485 19.6425 1.4569 19.6386 1.46001C19.6424 1.4559 19.6444 1.45435 19.6444 1.4546ZM19.3614 1.46001C19.3575 1.4569 19.3556 1.45485 19.3556 1.4546C19.3556 1.45435 19.3576 1.4559 19.3614 1.46001Z,M8.03906 2.70312C8.15556 2.70312 8.25 2.60869 8.25 2.49219C8.25 2.37569 8.15556 2.28125 8.03906 2.28125C7.92256 2.28125 7.82812 2.37569 7.82812 2.49219C7.82812 2.60869 7.92256 2.70312 8.03906 2.70312Z,M8.39062 3.40625C8.22186 3.65234 8.3414 3.83515 8.39062 3.96875C8.42577 4.06015 8.44687 4.26406 8.4539 4.3625C8.49608 4.78437 8.52421 6.06406 8.52421 6.06406C8.53124 6.1414 8.47499 6.19062 8.41874 6.19062C8.36249 6.19062 8.3203 6.14843 8.31327 6.09922L8.12343 4.46093C8.1164 4.41875 8.08827 4.38359 8.03905 4.38359C7.98983 4.38359 7.96171 4.41875 7.95468 4.46093L7.76483 6.09922C7.7578 6.14843 7.71561 6.19062 7.65936 6.19062C7.60311 6.19062 7.54686 6.1414 7.5539 6.06406C7.5539 6.06406 7.58905 4.7914 7.63124 4.37656C7.63827 4.27109 7.65936 4.06718 7.68749 3.96172C7.72968 3.82812 7.85624 3.63125 7.68749 3.39922,M7.4625 3.33594C7.46953 3.13906 7.63125 2.98438 7.82812 2.98438H8.25C8.44687 2.98438 8.60859 3.13906 8.61563 3.33594C8.61563 3.33594 8.62266 3.80703 8.63672 3.98984C8.66484 4.33437 8.8125 4.73516 8.8125 4.73516C8.54531 4.73516 8.28516 3.44844 8.03906 3.44844C7.79297 3.44844 7.63828 4.73516 7.40625 4.73516L7.4625 3.33594Z,M8.0337 4.13996C8.02696 3.82042 7.95924 3.5051 7.83419 3.21096C7.03614 3.58361 6.44991 4.28674 6.24952 5.11643C6.36679 5.38512 6.53686 5.62752 6.74962 5.82922C6.95195 5.12567 7.40994 4.52316 8.0337 4.13996ZM7.70939 2.95871C7.57571 2.72581 7.40536 2.51599 7.20489 2.33733C6.40509 2.77502 5.93224 3.68117 6.10626 4.64182C6.39981 3.91145 6.9711 3.30588 7.70939 2.95871ZM9.35821 4.40979C9.4338 3.53264 9.11827 2.67395 8.50128 2.08596C8.37208 2.07102 8.04776 2.03762 7.63204 2.16066C8.14068 2.68773 8.4338 3.38597 8.45382 4.11817C8.73391 4.27219 9.0409 4.37118 9.35821 4.40979ZM8.26222 4.49328C7.98885 4.65926 7.74962 4.87582 7.55733 5.13137C8.27804 5.63498 9.17892 5.79143 9.9963 5.55149C10.1721 5.31592 10.2983 5.04711 10.3672 4.76135C10.1348 4.82057 9.89601 4.85127 9.65616 4.85276C9.17628 4.85188 8.69903 4.72883 8.26222 4.49328ZM7.39825 5.36955C7.26466 5.59807 7.17237 5.84768 7.11612 6.10959C7.506 6.34889 7.96149 6.45895 8.41762 6.42407C8.87374 6.38919 9.3072 6.21115 9.65616 5.91535C8.66388 6.05686 7.86935 5.69738 7.39825 5.36955ZM8.98292 2.20022C9.46896 2.81897 9.70802 3.61701 9.63858 4.42912C9.90634 4.42969 10.1725 4.38756 10.427 4.30432C10.427 4.28674 10.4296 4.26916 10.4296 4.25158C10.4296 3.30412 9.82579 2.50168 8.98292 2.20022Z,M14.0391 14.7031C14.1556 14.7031 14.25 14.6087 14.25 14.4922C14.25 14.3757 14.1556 14.2812 14.0391 14.2812C13.9226 14.2812 13.8281 14.3757 13.8281 14.4922C13.8281 14.6087 13.9226 14.7031 14.0391 14.7031Z,M14.3906 15.4062C14.2219 15.6523 14.3414 15.8352 14.3906 15.9687C14.4258 16.0602 14.4469 16.2641 14.4539 16.3625C14.4961 16.7844 14.5242 18.0641 14.5242 18.0641C14.5312 18.1414 14.475 18.1906 14.4187 18.1906C14.3625 18.1906 14.3203 18.1484 14.3133 18.0992L14.1234 16.4609C14.1164 16.4187 14.0883 16.3836 14.0391 16.3836C13.9898 16.3836 13.9617 16.4187 13.9547 16.4609L13.7648 18.0992C13.7578 18.1484 13.7156 18.1906 13.6594 18.1906C13.6031 18.1906 13.5469 18.1414 13.5539 18.0641C13.5539 18.0641 13.5891 16.7914 13.6312 16.3766C13.6383 16.2711 13.6594 16.0672 13.6875 15.9617C13.7297 15.8281 13.8562 15.6312 13.6875 15.3992,M13.4625 15.3359C13.4695 15.1391 13.6313 14.9844 13.8281 14.9844H14.25C14.4469 14.9844 14.6086 15.1391 14.6156 15.3359C14.6156 15.3359 14.6227 15.807 14.6367 15.9898C14.6648 16.3344 14.8125 16.7352 14.8125 16.7352C14.5453 16.7352 14.2852 15.4484 14.0391 15.4484C13.793 15.4484 13.6383 16.7352 13.4062 16.7352L13.4625 15.3359Z,M14.0337 16.14C14.027 15.8204 13.9592 15.5051 13.8342 15.211C13.0361 15.5836 12.4499 16.2867 12.2495 17.1164C12.3668 17.3851 12.5369 17.6275 12.7496 17.8292C12.9519 17.1257 13.4099 16.5232 14.0337 16.14ZM13.7094 14.9587C13.5757 14.7258 13.4054 14.516 13.2049 14.3373C12.4051 14.775 11.9322 15.6812 12.1063 16.6418C12.3998 15.9114 12.9711 15.3059 13.7094 14.9587ZM15.3582 16.4098C15.4338 15.5326 15.1183 14.6739 14.5013 14.086C14.3721 14.071 14.0478 14.0376 13.632 14.1607C14.1407 14.6877 14.4338 15.386 14.4538 16.1182C14.7339 16.2722 15.0409 16.3712 15.3582 16.4098ZM14.2622 16.4933C13.9888 16.6593 13.7496 16.8758 13.5573 17.1314C14.278 17.635 15.1789 17.7914 15.9963 17.5515C16.1721 17.3159 16.2983 17.0471 16.3672 16.7613C16.1348 16.8206 15.896 16.8513 15.6562 16.8528C15.1763 16.8519 14.699 16.7288 14.2622 16.4933ZM13.3983 17.3696C13.2647 17.5981 13.1724 17.8477 13.1161 18.1096C13.506 18.3489 13.9615 18.4589 14.4176 18.4241C14.8737 18.3892 15.3072 18.2111 15.6562 17.9154C14.6639 18.0569 13.8693 17.6974 13.3983 17.3696ZM14.9829 14.2002C15.469 14.819 15.708 15.617 15.6386 16.4291C15.9063 16.4297 16.1725 16.3876 16.427 16.3043C16.427 16.2867 16.4296 16.2692 16.4296 16.2516C16.4296 15.3041 15.8258 14.5017 14.9829 14.2002Z,M14.0391 8.70312C14.1556 8.70312 14.25 8.60869 14.25 8.49219C14.25 8.37569 14.1556 8.28125 14.0391 8.28125C13.9226 8.28125 13.8281 8.37569 13.8281 8.49219C13.8281 8.60869 13.9226 8.70312 14.0391 8.70312Z,M14.3906 9.40625C14.2219 9.65234 14.3414 9.83515 14.3906 9.96875C14.4258 10.0602 14.4469 10.2641 14.4539 10.3625C14.4961 10.7844 14.5242 12.0641 14.5242 12.0641C14.5312 12.1414 14.475 12.1906 14.4187 12.1906C14.3625 12.1906 14.3203 12.1484 14.3133 12.0992L14.1234 10.4609C14.1164 10.4187 14.0883 10.3836 14.0391 10.3836C13.9898 10.3836 13.9617 10.4187 13.9547 10.4609L13.7648 12.0992C13.7578 12.1484 13.7156 12.1906 13.6594 12.1906C13.6031 12.1906 13.5469 12.1414 13.5539 12.0641C13.5539 12.0641 13.5891 10.7914 13.6312 10.3766C13.6383 10.2711 13.6594 10.0672 13.6875 9.96172C13.7297 9.82812 13.8562 9.63125 13.6875 9.39922,M13.4625 9.33594C13.4695 9.13906 13.6313 8.98438 13.8281 8.98438H14.25C14.4469 8.98438 14.6086 9.13906 14.6156 9.33594C14.6156 9.33594 14.6227 9.80703 14.6367 9.98984C14.6648 10.3344 14.8125 10.7352 14.8125 10.7352C14.5453 10.7352 14.2852 9.44844 14.0391 9.44844C13.793 9.44844 13.6383 10.7352 13.4062 10.7352L13.4625 9.33594Z,M14.0337 10.14C14.027 9.82042 13.9592 9.5051 13.8342 9.21096C13.0361 9.58361 12.4499 10.2867 12.2495 11.1164C12.3668 11.3851 12.5369 11.6275 12.7496 11.8292C12.9519 11.1257 13.4099 10.5232 14.0337 10.14ZM13.7094 8.95871C13.5757 8.72581 13.4054 8.51599 13.2049 8.33733C12.4051 8.77502 11.9322 9.68117 12.1063 10.6418C12.3998 9.91145 12.9711 9.30588 13.7094 8.95871ZM15.3582 10.4098C15.4338 9.53264 15.1183 8.67395 14.5013 8.08596C14.3721 8.07102 14.0478 8.03762 13.632 8.16066C14.1407 8.68773 14.4338 9.38597 14.4538 10.1182C14.7339 10.2722 15.0409 10.3712 15.3582 10.4098ZM14.2622 10.4933C13.9888 10.6593 13.7496 10.8758 13.5573 11.1314C14.278 11.635 15.1789 11.7914 15.9963 11.5515C16.1721 11.3159 16.2983 11.0471 16.3672 10.7613C16.1348 10.8206 15.896 10.8513 15.6562 10.8528C15.1763 10.8519 14.699 10.7288 14.2622 10.4933ZM13.3983 11.3696C13.2647 11.5981 13.1724 11.8477 13.1161 12.1096C13.506 12.3489 13.9615 12.4589 14.4176 12.4241C14.8737 12.3892 15.3072 12.2111 15.6562 11.9154C14.6639 12.0569 13.8693 11.6974 13.3983 11.3696ZM14.9829 8.20022C15.469 8.81897 15.708 9.61701 15.6386 10.4291C15.9063 10.4297 16.1725 10.3876 16.427 10.3043C16.427 10.2867 16.4296 10.2692 16.4296 10.2516C16.4296 9.30412 15.8258 8.50168 14.9829 8.20022Z,M8.03906 8.70312C8.15556 8.70312 8.25 8.60869 8.25 8.49219C8.25 8.37569 8.15556 8.28125 8.03906 8.28125C7.92256 8.28125 7.82812 8.37569 7.82812 8.49219C7.82812 8.60869 7.92256 8.70312 8.03906 8.70312Z,M8.39062 9.40625C8.22186 9.65234 8.3414 9.83515 8.39062 9.96875C8.42577 10.0602 8.44687 10.2641 8.4539 10.3625C8.49608 10.7844 8.52421 12.0641 8.52421 12.0641C8.53124 12.1414 8.47499 12.1906 8.41874 12.1906C8.36249 12.1906 8.3203 12.1484 8.31327 12.0992L8.12343 10.4609C8.1164 10.4187 8.08827 10.3836 8.03905 10.3836C7.98983 10.3836 7.96171 10.4187 7.95468 10.4609L7.76483 12.0992C7.7578 12.1484 7.71561 12.1906 7.65936 12.1906C7.60311 12.1906 7.54686 12.1414 7.5539 12.0641C7.5539 12.0641 7.58905 10.7914 7.63124 10.3766C7.63827 10.2711 7.65936 10.0672 7.68749 9.96172C7.72968 9.82812 7.85624 9.63125 7.68749 9.39922,M7.4625 9.33594C7.46953 9.13906 7.63125 8.98438 7.82812 8.98438H8.25C8.44687 8.98438 8.60859 9.13906 8.61563 9.33594C8.61563 9.33594 8.62266 9.80703 8.63672 9.98984C8.66484 10.3344 8.8125 10.7352 8.8125 10.7352C8.54531 10.7352 8.28516 9.44844 8.03906 9.44844C7.79297 9.44844 7.63828 10.7352 7.40625 10.7352L7.4625 9.33594Z,M8.0337 10.14C8.02696 9.82042 7.95924 9.5051 7.83419 9.21096C7.03614 9.58361 6.44991 10.2867 6.24952 11.1164C6.36679 11.3851 6.53686 11.6275 6.74962 11.8292C6.95195 11.1257 7.40994 10.5232 8.0337 10.14ZM7.70939 8.95871C7.57571 8.72581 7.40536 8.51599 7.20489 8.33733C6.40509 8.77502 5.93224 9.68117 6.10626 10.6418C6.39981 9.91145 6.9711 9.30588 7.70939 8.95871ZM9.35821 10.4098C9.4338 9.53264 9.11827 8.67395 8.50128 8.08596C8.37208 8.07102 8.04776 8.03762 7.63204 8.16066C8.14068 8.68773 8.4338 9.38597 8.45382 10.1182C8.73391 10.2722 9.0409 10.3712 9.35821 10.4098ZM8.26222 10.4933C7.98885 10.6593 7.74962 10.8758 7.55733 11.1314C8.27804 11.635 9.17892 11.7914 9.9963 11.5515C10.1721 11.3159 10.2983 11.0471 10.3672 10.7613C10.1348 10.8206 9.89601 10.8513 9.65616 10.8528C9.17628 10.8519 8.69903 10.7288 8.26222 10.4933ZM7.39825 11.3696C7.26466 11.5981 7.17237 11.8477 7.11612 12.1096C7.506 12.3489 7.96149 12.4589 8.41762 12.4241C8.87374 12.3892 9.3072 12.2111 9.65616 11.9154C8.66388 12.0569 7.86935 11.6974 7.39825 11.3696ZM8.98292 8.20022C9.46896 8.81897 9.70802 9.61701 9.63858 10.4291C9.90634 10.4297 10.1725 10.3876 10.427 10.3043C10.427 10.2867 10.4296 10.2692 10.4296 10.2516C10.4296 9.30412 9.82579 8.50168 8.98292 8.20022Z,M8.03906 14.7031C8.15556 14.7031 8.25 14.6087 8.25 14.4922C8.25 14.3757 8.15556 14.2812 8.03906 14.2812C7.92256 14.2812 7.82812 14.3757 7.82812 14.4922C7.82812 14.6087 7.92256 14.7031 8.03906 14.7031Z,M8.39062 15.4062C8.22186 15.6523 8.3414 15.8352 8.39062 15.9687C8.42577 16.0602 8.44687 16.2641 8.4539 16.3625C8.49608 16.7844 8.52421 18.0641 8.52421 18.0641C8.53124 18.1414 8.47499 18.1906 8.41874 18.1906C8.36249 18.1906 8.3203 18.1484 8.31327 18.0992L8.12343 16.4609C8.1164 16.4187 8.08827 16.3836 8.03905 16.3836C7.98983 16.3836 7.96171 16.4187 7.95468 16.4609L7.76483 18.0992C7.7578 18.1484 7.71561 18.1906 7.65936 18.1906C7.60311 18.1906 7.54686 18.1414 7.5539 18.0641C7.5539 18.0641 7.58905 16.7914 7.63124 16.3766C7.63827 16.2711 7.65936 16.0672 7.68749 15.9617C7.72968 15.8281 7.85624 15.6312 7.68749 15.3992,M7.4625 15.3359C7.46953 15.1391 7.63125 14.9844 7.82812 14.9844H8.25C8.44687 14.9844 8.60859 15.1391 8.61563 15.3359C8.61563 15.3359 8.62266 15.807 8.63672 15.9898C8.66484 16.3344 8.8125 16.7352 8.8125 16.7352C8.54531 16.7352 8.28516 15.4484 8.03906 15.4484C7.79297 15.4484 7.63828 16.7352 7.40625 16.7352L7.4625 15.3359Z,M8.0337 16.14C8.02696 15.8204 7.95924 15.5051 7.83419 15.211C7.03614 15.5836 6.44991 16.2867 6.24952 17.1164C6.36679 17.3851 6.53686 17.6275 6.74962 17.8292C6.95195 17.1257 7.40994 16.5232 8.0337 16.14ZM7.70939 14.9587C7.57571 14.7258 7.40536 14.516 7.20489 14.3373C6.40509 14.775 5.93224 15.6812 6.10626 16.6418C6.39981 15.9114 6.9711 15.3059 7.70939 14.9587ZM9.35821 16.4098C9.4338 15.5326 9.11827 14.6739 8.50128 14.086C8.37208 14.071 8.04776 14.0376 7.63204 14.1607C8.14068 14.6877 8.4338 15.386 8.45382 16.1182C8.73391 16.2722 9.0409 16.3712 9.35821 16.4098ZM8.26222 16.4933C7.98885 16.6593 7.74962 16.8758 7.55733 17.1314C8.27804 17.635 9.17892 17.7914 9.9963 17.5515C10.1721 17.3159 10.2983 17.0471 10.3672 16.7613C10.1348 16.8206 9.89601 16.8513 9.65616 16.8528C9.17628 16.8519 8.69903 16.7288 8.26222 16.4933ZM7.39825 17.3696C7.26466 17.5981 7.17237 17.8477 7.11612 18.1096C7.506 18.3489 7.96149 18.4589 8.41762 18.4241C8.87374 18.3892 9.3072 18.2111 9.65616 17.9154C8.66388 18.0569 7.86935 17.6974 7.39825 17.3696ZM8.98292 14.2002C9.46896 14.819 9.70802 15.617 9.63858 16.4291C9.90634 16.4297 10.1725 16.3876 10.427 16.3043C10.427 16.2867 10.4296 16.2692 10.4296 16.2516C10.4296 15.3041 9.82579 14.5017 8.98292 14.2002Z',
    "soccernet":'M8.96204 4.66312V13.5703,M5.51672 4.66312L6.5011 6.60234V13.5703,M12.4073 4.66312L11.423 6.60234V13.5703,M4.56187 13.3988H13.3636,M2.88844 5.90625V13.9936,M4.07391 8.90297L0.999847 8.60063,M4.52672 11.1178L0.999847 11.5045,M4.12312 8.92266H13.8755,M3.98953 11.16H13.7841,M3.58594 6.68391H14.3381,M1.0786 14.8528L4.49157 13.4888,M15.1172 5.90625V13.9936,M13.9317 8.90297L17.0058 8.60063,M13.4789 11.1178L17.0058 11.5045,M16.9256 14.8528L13.5141 13.4888,M5.19048 10.1503C5.10891 8.99438 4.86141 7.86656 4.47469 6.88922C4.14844 6.06234 3.72516 5.35078 3.2836 4.88672C3.05547 4.64904 2.78873 4.45171 2.49469 4.30313C2.36813 4.23984 2.23313 4.21453 2.09251 4.22719C1.79298 4.25391 1.5286 4.46625 1.44141 4.75453C1.32329 5.14266 1.52719 5.52797 1.8886 5.67984C2.00954 5.73047 2.13469 5.82609 2.25141 5.92313C4.14563 7.48547 4.0486 12.3005 3.97407 13.7391C3.96563 13.8994 4.0936 14.0344 4.25532 14.0344H4.95704C5.1061 14.0344 5.22985 13.9177 5.23829 13.7672C5.23688 13.7503 5.32126 12.0108 5.19048 10.1503V10.1503Z,M12.8095 10.1503C12.8911 8.99438 13.1386 7.86656 13.5253 6.88922C13.8516 6.06234 14.2748 5.35078 14.7164 4.88672C14.9386 4.65328 15.2184 4.44656 15.5053 4.30313C15.6319 4.23984 15.7669 4.21453 15.9075 4.22719C16.207 4.25391 16.4714 4.46625 16.5586 4.75453C16.6767 5.14266 16.4728 5.52797 16.1114 5.67984C15.9905 5.73047 15.8653 5.82609 15.7486 5.92313C13.8572 7.48547 13.9528 12.2991 14.0273 13.7377C14.0358 13.898 13.9078 14.033 13.7461 14.033H13.0444C12.8953 14.033 12.7716 13.9163 12.7631 13.7658C12.7617 13.7503 12.6773 12.0108 12.8095 10.1503V10.1503Z,M2.15859 4.64625C2.21062 4.64625 2.25843 4.6575 2.30624 4.68141C2.55093 4.80234 2.78859 4.97953 2.97703 5.17781C3.38203 5.60391 3.77437 6.26766 4.08093 7.04531C4.45218 7.98328 4.68984 9.0675 4.76859 10.1812C4.87828 11.7211 4.83749 13.1752 4.82062 13.6125H4.40156C4.43812 12.7884 4.46062 11.3203 4.26796 9.82266C4.00218 7.75687 3.41296 6.33516 2.51859 5.59687C2.37656 5.48016 2.22328 5.36203 2.05031 5.29031C1.87734 5.21719 1.79156 5.04844 1.84359 4.87687C1.88156 4.75312 1.99828 4.65891 2.12765 4.64766C2.1389 4.64625 2.14874 4.64625 2.15859 4.64625V4.64625ZM2.15859 4.22437C2.13609 4.22437 2.11359 4.22578 2.09109 4.22719C1.79156 4.25391 1.52718 4.46625 1.43999 4.75453C1.32187 5.14266 1.52578 5.52797 1.88718 5.67984C2.00812 5.73047 2.13328 5.82609 2.24999 5.92312C4.14421 7.48547 4.04718 12.3005 3.97265 13.7391C3.96421 13.8994 4.09218 14.0344 4.2539 14.0344H4.95562C5.10468 14.0344 5.22843 13.9177 5.23687 13.7672C5.23828 13.7503 5.32265 12.0094 5.19046 10.1503C5.1089 8.99437 4.8614 7.86656 4.47468 6.88922C4.14843 6.06234 3.72515 5.35078 3.28359 4.88672C3.05546 4.64903 2.78872 4.45171 2.49468 4.30312C2.39016 4.25147 2.27517 4.22453 2.15859 4.22437V4.22437Z,M15.8414 4.64625C15.8512 4.64625 15.8611 4.64625 15.8723 4.64766C16.0017 4.65891 16.1198 4.75312 16.1564 4.87687C16.2084 5.04844 16.1241 5.21719 15.9497 5.29031C15.7781 5.36203 15.6234 5.48016 15.4814 5.59687C14.587 6.33516 13.9978 7.75687 13.732 9.82266C13.5394 11.3203 13.5619 12.7884 13.5984 13.6125H13.1794C13.1625 13.1737 13.1217 11.7211 13.2314 10.1812C13.3102 9.0675 13.5478 7.98328 13.9191 7.04531C14.227 6.26766 14.6194 5.60391 15.023 5.17781C15.2114 4.97953 15.4491 4.80375 15.6937 4.68141C15.7416 4.6575 15.7894 4.64625 15.8414 4.64625V4.64625ZM15.8414 4.22437C15.7247 4.22437 15.6122 4.25109 15.5067 4.30312C15.2122 4.451 14.9454 4.6484 14.7178 4.88672C14.2762 5.35078 13.8544 6.06234 13.5267 6.88922C13.14 7.86656 12.8925 8.99437 12.8109 10.1503C12.6787 12.0094 12.7631 13.7489 12.7645 13.7672C12.773 13.9162 12.8953 14.0344 13.0458 14.0344H13.7475C13.9092 14.0344 14.0372 13.8994 14.0287 13.7391C13.9528 12.2991 13.8572 7.48547 15.75 5.92312C15.8667 5.8275 15.9905 5.73187 16.1128 5.67984C16.4742 5.52797 16.6781 5.14266 16.56 4.75453C16.4728 4.46625 16.2084 4.25391 15.9089 4.22719C15.8864 4.22578 15.8639 4.22437 15.8414 4.22437V4.22437Z,M1.82532 15.3675H0.981567C0.74813 15.3675 0.559692 15.1791 0.559692 14.9456L0.566724 5.0625C0.566724 4.33125 1.16016 3.73922 1.89 3.73922H16.1156C16.8469 3.73922 17.4389 4.33125 17.4389 5.0625V14.9442C17.4389 15.1777 17.2505 15.3661 17.017 15.3661H16.1733C15.9398 15.3661 15.7514 15.1777 15.7514 14.9442V6.18891C15.7514 5.76844 15.4111 5.42813 14.9906 5.42813H2.73516C2.60804 5.42831 2.48618 5.47889 2.39629 5.56878C2.3064 5.65867 2.25582 5.78053 2.25563 5.90766L2.2486 14.947C2.24789 15.0588 2.20298 15.1658 2.12367 15.2446C2.04436 15.3233 1.9371 15.3675 1.82532 15.3675V15.3675Z,M16.1156 4.16109C16.6134 4.16109 17.017 4.56609 17.017 5.0625V14.9442H16.1733V6.18891C16.1733 5.53641 15.6431 5.00625 14.9906 5.00625H2.73516C2.49469 5.00625 2.26828 5.10047 2.09813 5.27063C1.92797 5.44078 1.83375 5.66719 1.83375 5.90766L1.82672 14.947H0.982971L0.988596 5.0625C0.988596 4.56609 1.3936 4.16109 1.89 4.16109H16.1156ZM16.1156 3.73922H1.89141C1.16016 3.73922 0.568127 4.33125 0.568127 5.0625L0.561096 14.9456C0.561096 15.1791 0.749534 15.3675 0.982971 15.3675H1.82672C2.06016 15.3675 2.2486 15.1791 2.2486 14.9456L2.25563 5.90625C2.25581 5.77913 2.30639 5.65727 2.39628 5.56738C2.48617 5.47749 2.60804 5.42691 2.73516 5.42672H14.992C15.4125 5.42672 15.7528 5.76703 15.7528 6.1875V14.9442C15.7528 15.1777 15.9413 15.3661 16.1747 15.3661H17.0184C17.2519 15.3661 17.4403 15.1777 17.4403 14.9442V5.06391C17.4403 4.33266 16.8469 3.73922 16.1156 3.73922V3.73922Z',
    "soccerball":'M17.98 8.99745C17.9863 8.78355 18.0427 5.7263 16.2334 3.73614C16.153 3.55824 15.7717 2.84125 14.5411 1.96497C13.9956 1.5418 13.4161 1.16423 12.8086 0.836086L12.8062 0.834886C12.7294 0.793787 11.2288 0 9.40755 0C9.26926 0 9.13246 0.00809989 8.99716 0.0173997V0.0149997C7.60847 -0.0152998 6.22908 0.341994 5.39779 0.717288C4.66039 1.05028 3.8417 1.60857 3.7826 1.65177C2.76141 2.22296 0.82492 4.51523 0.671621 5.7299C0.0527257 6.52099 -0.46447 10.0744 0.672821 12.2389C1.47021 15.2469 4.47199 16.7523 4.71079 16.8678C4.85599 16.9605 6.49188 17.9718 8.50156 17.9718C8.58586 17.9718 9.09556 18 9.27736 18C11.4496 18 14.6686 16.4688 15.3424 15.2694C17.1937 13.9153 18.1534 10.4254 17.98 8.99745ZM4.72729 13.5163C3.8666 12.124 3.3761 10.3048 3.2711 9.88694C3.5435 9.47864 4.88719 7.49747 5.65278 6.90138C6.08628 6.98118 7.89647 7.31358 9.60375 7.62257C9.81825 8.17846 10.7593 10.6312 11.0287 11.578C10.7317 11.9302 9.56505 13.2886 8.41636 14.3524C7.19687 14.3581 5.12269 13.6546 4.72729 13.5163ZM15.547 3.77394C15.5434 3.90893 15.5113 4.38893 15.2815 4.94002C14.8252 4.70692 13.6783 4.20773 12.1063 4.12343C11.8684 3.77214 10.9732 2.54726 9.55935 1.69767C9.75285 1.31908 10.0222 0.857386 10.1797 0.716688C10.2307 0.702288 10.3099 0.689089 10.4305 0.689089C11.1886 0.689089 12.4984 1.18558 12.6124 1.22968C12.7333 1.29358 15.0877 2.56136 15.547 3.77394ZM2.9318 9.60344C1.90491 9.42824 1.29442 9.10905 1.11202 9.00105C0.73012 7.61597 1.03762 6.119 1.08502 5.9045C1.46182 5.23071 2.53461 3.51324 3.2423 3.18715C3.9758 3.03745 4.89049 3.22345 5.26309 3.31434C5.22799 3.79884 5.16049 5.15241 5.36089 6.57289C4.54909 7.22628 3.2642 9.10695 2.9318 9.60344V9.60344ZM8.90536 0.458992C9.13576 0.476092 9.47385 0.526491 9.70545 0.59519C9.47445 0.902385 9.23776 1.35778 9.12586 1.58277C8.65486 1.65987 6.86597 2.00187 5.46258 2.91175C5.17969 2.83675 4.32529 2.63666 3.5162 2.70565C3.7166 2.31776 4.016 2.03097 4.0481 2.00157C4.15939 1.92177 6.30198 0.422693 8.90536 0.455092V0.458992V0.458992ZM14.6341 11.8867C14.2831 11.8723 12.9307 11.7952 11.4478 11.4469C11.1637 10.4563 10.2256 8.01377 10.0111 7.45818C10.6936 6.48542 11.3865 5.51999 12.0895 4.56202C13.7959 4.65562 14.9941 5.27811 15.226 5.40801C16.2145 6.99768 16.4314 8.62126 16.4611 8.89245C15.9361 10.5262 14.8978 11.6263 14.6341 11.8867V11.8867ZM0.496422 7.95557C0.521622 8.33536 0.582522 8.73525 0.692621 9.13065C0.593638 9.38686 0.524972 9.65377 0.488022 9.92594C0.425369 9.2705 0.428183 8.61045 0.496422 7.95557V7.95557ZM3.3896 14.9632C3.842 14.5273 4.39969 14.1031 4.61599 13.9429C5.10499 14.1151 7.11317 14.794 8.39326 14.794C8.61136 15.0864 9.32445 16.0023 10.1986 16.7025C9.65445 17.235 8.86846 17.4864 8.72956 17.5281C6.29148 17.5935 3.917 16.2231 3.3896 14.9632V14.9632ZM9.82845 17.5245C10.105 17.3634 10.3933 17.1513 10.6318 16.8828C11.0209 16.8291 12.6907 16.5417 14.1997 15.4332C14.2993 15.444 14.4634 15.4572 14.6467 15.4521C13.7413 16.3392 11.5321 17.3301 9.82845 17.5245ZM14.4556 15.0118C14.9977 13.5994 14.9746 12.5344 14.9479 12.1942C15.2455 11.9026 16.2667 10.8145 16.8334 9.16035C17.1388 9.21135 17.3374 9.28905 17.4316 9.33254C17.4643 9.45254 17.5189 9.72974 17.488 10.15C17.257 11.6629 16.4596 13.93 15.0628 14.9323C14.9224 15.004 14.6752 15.0196 14.4556 15.0118',
    "mininet":'M5.82587 7.6725C5.75587 7.6725 5.69462 7.62 5.68087 7.545C5.05587 3.8975 3.84712 1.66875 3.83462 1.6475C3.79462 1.57375 3.81837 1.47875 3.88837 1.43625C3.95837 1.39375 4.04837 1.41875 4.08962 1.4925C4.10212 1.515 5.33587 3.785 5.97087 7.49C5.98462 7.57375 5.93212 7.65375 5.85212 7.66875C5.84337 7.6725 5.83462 7.6725 5.82587 7.6725V7.6725Z,M7.41962 7.6725C7.34962 7.6725 7.28837 7.62 7.27462 7.545C6.64962 3.8975 5.44087 1.66875 5.42837 1.6475C5.38837 1.57375 5.41212 1.47875 5.48212 1.43625C5.55212 1.39375 5.64212 1.41875 5.68337 1.4925C5.69587 1.515 6.92962 3.785 7.56462 7.49C7.57837 7.57375 7.52587 7.65375 7.44587 7.66875C7.43712 7.6725 7.42837 7.6725 7.41962 7.6725V7.6725Z,M8.88086 7.6725C8.81086 7.6725 8.74836 7.62 8.73586 7.545C8.11086 3.8975 6.90211 1.66875 6.88961 1.6475C6.84961 1.57375 6.87336 1.47875 6.94336 1.43625C7.01336 1.39375 7.10336 1.41875 7.14461 1.4925C7.15711 1.515 8.39086 3.785 9.02461 7.49C9.03961 7.57375 8.98586 7.65375 8.90586 7.66875C8.89836 7.6725 8.88836 7.6725 8.88086 7.6725V7.6725Z,M2.82836 7.6725C2.81961 7.6725 2.81086 7.67125 2.80211 7.67C2.72211 7.655 2.66836 7.575 2.68336 7.49125C3.31836 3.78625 4.55211 1.51625 4.56461 1.49375C4.60461 1.42 4.69461 1.395 4.76586 1.4375C4.83586 1.48 4.85961 1.575 4.81961 1.64875C4.80711 1.67 3.59836 3.89875 2.97336 7.54625C2.96086 7.62 2.89836 7.6725 2.82836 7.6725V7.6725Z,M4.30212 7.6725C4.29337 7.6725 4.28462 7.67125 4.27587 7.67C4.19587 7.655 4.14337 7.575 4.15712 7.49125C4.79212 3.78625 6.02587 1.51625 6.03837 1.49375C6.04749 1.47644 6.06004 1.46117 6.07525 1.44888C6.09047 1.43659 6.10804 1.42753 6.12688 1.42227C6.14572 1.417 6.16544 1.41564 6.18482 1.41826C6.20421 1.42088 6.22286 1.42742 6.23962 1.4375C6.30962 1.48 6.33462 1.575 6.29337 1.64875C6.28087 1.67 5.07212 3.89875 4.44712 7.54625C4.43337 7.62 4.37087 7.6725 4.30212 7.6725Z,M5.88211 7.6725C5.87336 7.6725 5.86461 7.67125 5.85586 7.67C5.77586 7.655 5.72336 7.575 5.73711 7.49125C6.37211 3.78625 7.60586 1.51625 7.61836 1.49375C7.62747 1.47644 7.64002 1.46117 7.65524 1.44888C7.67046 1.43659 7.68803 1.42753 7.70687 1.42227C7.72571 1.417 7.74542 1.41564 7.76481 1.41826C7.7842 1.42088 7.80284 1.42742 7.81961 1.4375C7.88961 1.48 7.91461 1.575 7.87336 1.64875C7.86086 1.67 6.65211 3.89875 6.02711 7.54625C6.01461 7.62 5.95211 7.6725 5.88211 7.6725Z,M7.42086 7.6725C7.41211 7.6725 7.40336 7.67125 7.39461 7.67C7.31461 7.655 7.26086 7.575 7.27586 7.49125C7.91086 3.7875 9.08461 1.51875 9.09711 1.49625C9.13586 1.42125 9.22586 1.39375 9.29711 1.435C9.36836 1.47625 9.39461 1.57 9.35586 1.645C9.34461 1.6675 8.19211 3.89625 7.56711 7.54625C7.55211 7.62 7.48961 7.6725 7.42086 7.6725V7.6725Z,M8.88085 7.6725C8.8721 7.6725 8.86335 7.67125 8.8546 7.67C8.7746 7.655 8.72085 7.575 8.73585 7.49125C9.37085 3.78625 10.6046 1.51625 10.6171 1.49375C10.6584 1.42 10.7484 1.395 10.8184 1.4375C10.8884 1.48 10.9121 1.575 10.8721 1.64875C10.8596 1.67 9.65085 3.89875 9.02585 7.54625C9.0121 7.62 8.9496 7.6725 8.88085 7.6725V7.6725Z,M10.3971 7.6725C10.3884 7.6725 10.3796 7.67125 10.3709 7.67C10.2909 7.655 10.2371 7.575 10.2521 7.49125C10.8871 3.78625 12.1209 1.51625 12.1334 1.49375C12.1746 1.42 12.2634 1.395 12.3346 1.4375C12.4046 1.48 12.4284 1.575 12.3884 1.64875C12.3759 1.67 11.1671 3.89875 10.5421 7.54625C10.5284 7.62 10.4659 7.6725 10.3971 7.6725V7.6725Z,M11.9134 7.6725C11.9046 7.6725 11.8959 7.67125 11.8871 7.67C11.8071 7.655 11.7534 7.575 11.7684 7.49125C12.2046 4.945 12.9209 3.085 13.3096 2.20375C13.3446 2.12625 13.4309 2.0925 13.5046 2.12875C13.5784 2.165 13.6109 2.25625 13.5771 2.33375C13.1946 3.2025 12.4884 5.03375 12.0584 7.54625C12.0446 7.62 11.9834 7.6725 11.9134 7.6725V7.6725Z,M10.3959 7.6725C10.3259 7.6725 10.2634 7.62 10.2509 7.545C9.62588 3.8975 8.41713 1.66875 8.40463 1.6475C8.36463 1.57375 8.38838 1.47875 8.45838 1.43625C8.52838 1.39375 8.61838 1.41875 8.65963 1.4925C8.67213 1.515 9.90588 3.785 10.5409 7.49C10.5559 7.57375 10.5021 7.65375 10.4221 7.66875C10.4134 7.6725 10.4046 7.6725 10.3959 7.6725V7.6725Z,M11.9134 7.6725C11.8434 7.6725 11.7809 7.62 11.7684 7.545C11.1434 3.8975 9.93461 1.66875 9.92211 1.6475C9.88211 1.57375 9.90586 1.47875 9.97586 1.43625C10.0459 1.39375 10.1359 1.41875 10.1771 1.4925C10.1896 1.515 11.4234 3.785 12.0584 7.49C12.0734 7.57375 12.0196 7.65375 11.9396 7.66875C11.9309 7.6725 11.9221 7.6725 11.9134 7.6725V7.6725Z,M13.3771 7.6725C13.3071 7.6725 13.2446 7.62 13.2321 7.545C12.6071 3.8975 11.3984 1.66875 11.3859 1.6475C11.3446 1.57375 11.3696 1.47875 11.4396 1.43625C11.5096 1.39375 11.5996 1.41875 11.6409 1.4925C11.6534 1.515 12.8871 3.785 13.5221 7.49C13.5371 7.57375 13.4834 7.65375 13.4034 7.66875C13.3946 7.6725 13.3859 7.6725 13.3771 7.6725V7.6725Z,M4.30087 7.6725C4.23087 7.6725 4.16962 7.62 4.15587 7.545C3.53087 3.8975 2.32212 1.66875 2.30962 1.6475C2.26962 1.57375 2.29337 1.47875 2.36337 1.43625C2.43337 1.39375 2.52337 1.41875 2.56462 1.4925C2.57712 1.515 3.81087 3.785 4.44587 7.49C4.45962 7.57375 4.40712 7.65375 4.32712 7.66875C4.31837 7.6725 4.30962 7.6725 4.30087 7.6725V7.6725Z,M2.82835 7.8525C2.75835 7.8525 2.6971 7.8 2.68335 7.725C2.42835 6.23875 2.0521 4.8175 1.56335 3.50125C1.5346 3.4225 1.5721 3.3325 1.6471 3.30125C1.72335 3.27 1.80835 3.31 1.8371 3.38875C2.3321 4.72375 2.71335 6.16375 2.9721 7.67C2.9871 7.75375 2.93335 7.83375 2.85335 7.84875C2.84585 7.85125 2.8371 7.8525 2.82835 7.8525V7.8525Z,M13.3784 7.8525C13.3696 7.8525 13.3609 7.85125 13.3521 7.85C13.2721 7.835 13.2196 7.755 13.2334 7.67125C13.4921 6.165 13.8734 4.725 14.3684 3.39C14.3984 3.31 14.4834 3.27125 14.5584 3.3025C14.6346 3.33375 14.6721 3.4225 14.6421 3.5025C14.1546 4.81875 13.7771 6.24 13.5234 7.72625C13.5096 7.8 13.4484 7.8525 13.3784 7.8525Z,M12.1221 7.9525C11.9196 7.94375 11.7621 7.765 11.7709 7.5525C11.9421 3.33 13.4046 0.994999 13.4671 0.897499C13.5809 0.719999 13.8096 0.672499 13.9771 0.789999C14.1459 0.907499 14.1909 1.1475 14.0771 1.325C14.0634 1.3475 12.6671 3.59375 12.5046 7.5825C12.4971 7.795 12.3246 7.96125 12.1221 7.9525Z,M4.55507 7.99968C4.81132 7.99121 5.01063 7.81811 4.99956 7.61232C4.78285 3.52331 2.93212 1.26091 2.85303 1.1665C2.70909 0.994608 2.41962 0.94861 2.20607 1.0624C1.99252 1.17618 1.93558 1.40859 2.07952 1.58048C2.09692 1.60227 3.86381 3.77751 4.06945 7.64017C4.08052 7.84716 4.29723 8.00815 4.55507 7.99968Z,M15.0171 8.73C14.9909 8.73 14.9646 8.7275 14.9371 8.72125C8.44211 7.28375 1.15086 8.70875 1.07711 8.7225C0.878361 8.7625 0.684611 8.63375 0.644611 8.43375C0.604611 8.23375 0.733361 8.04125 0.933361 8.00125C1.00711 7.98625 8.45211 6.53125 15.0959 8.0025C15.2946 8.04625 15.4196 8.2425 15.3746 8.44125C15.3571 8.52302 15.312 8.59629 15.2469 8.64884C15.1819 8.70138 15.1007 8.73003 15.0171 8.73V8.73Z,M15.2196 9.54875C14.6521 9.5525 14.6521 9.4575 14.4984 8.95125L13.1846 2.10375V2.03375C13.1846 1.775 12.7609 1.46875 12.4034 1.46875H3.61836C3.26086 1.46875 2.83711 1.775 2.83711 2.03375V2.10375L1.52461 8.9525C1.43461 9.58125 1.43461 9.58125 0.663364 9.53625C0.258364 9.5125 -0.184136 9.55 0.0796135 8.675L1.36836 1.95625C1.76586 2.38419e-07 2.57711 0 3.61961 0H12.4046C13.4471 0 14.2159 2.38419e-07 14.6559 1.95625L15.9446 8.675C16.1109 9.55375 15.9071 9.5675 15.3609 9.55375C15.3109 9.5525 15.2659 9.54875 15.2196 9.54875V9.54875Z',
    "archs":'M19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10',
    "fivesoccerball":'M8 10C7.60444 10 7.21776 9.8827 6.88886 9.66294C6.55996 9.44318 6.30362 9.13082 6.15224 8.76537C6.00087 8.39992 5.96126 7.99778 6.03843 7.60982C6.1156 7.22186 6.30608 6.86549 6.58579 6.58579C6.86549 6.30608 7.22186 6.1156 7.60982 6.03843C7.99778 5.96126 8.39992 6.00087 8.76537 6.15224C9.13082 6.30362 9.44318 6.55996 9.66294 6.88886C9.8827 7.21776 10 7.60444 10 8C9.99934 8.53023 9.78841 9.03855 9.41348 9.41348C9.03855 9.78841 8.53023 9.99934 8 10ZM8 7C7.80222 7 7.60888 7.05865 7.44443 7.16853C7.27998 7.27841 7.15181 7.43459 7.07612 7.61732C7.00043 7.80004 6.98063 8.00111 7.01922 8.19509C7.0578 8.38907 7.15304 8.56726 7.29289 8.70711C7.43275 8.84696 7.61093 8.9422 7.80491 8.98079C7.99889 9.01937 8.19996 8.99957 8.38268 8.92388C8.56541 8.84819 8.72159 8.72002 8.83147 8.55557C8.94135 8.39112 9 8.19778 9 8C8.99974 7.73487 8.89429 7.48067 8.70682 7.29319C8.51934 7.10571 8.26514 7.00027 8 7Z,M2.5 10C2.10444 10 1.71776 9.8827 1.38886 9.66294C1.05996 9.44318 0.803617 9.13082 0.652242 8.76537C0.500867 8.39992 0.46126 7.99778 0.53843 7.60982C0.615601 7.22186 0.806082 6.86549 1.08579 6.58579C1.36549 6.30608 1.72186 6.1156 2.10982 6.03843C2.49778 5.96126 2.89992 6.00087 3.26537 6.15224C3.63082 6.30362 3.94318 6.55996 4.16294 6.88886C4.3827 7.21776 4.5 7.60444 4.5 8C4.49934 8.53023 4.28841 9.03855 3.91348 9.41348C3.53855 9.78841 3.03023 9.99934 2.5 10ZM2.5 7C2.30222 7 2.10888 7.05865 1.94443 7.16853C1.77998 7.27841 1.65181 7.43459 1.57612 7.61732C1.50043 7.80004 1.48063 8.00111 1.51922 8.19509C1.5578 8.38907 1.65304 8.56726 1.79289 8.70711C1.93275 8.84696 2.11093 8.9422 2.30491 8.98079C2.49889 9.01937 2.69996 8.99957 2.88268 8.92388C3.06541 8.84819 3.22159 8.72002 3.33147 8.55557C3.44135 8.39112 3.5 8.19778 3.5 8C3.49974 7.73487 3.39429 7.48067 3.20682 7.29319C3.01934 7.10571 2.76514 7.00027 2.5 7Z,M5 15.5C4.60444 15.5 4.21776 15.3827 3.88886 15.1629C3.55996 14.9432 3.30362 14.6308 3.15224 14.2654C3.00087 13.8999 2.96126 13.4978 3.03843 13.1098C3.1156 12.7219 3.30608 12.3655 3.58579 12.0858C3.86549 11.8061 4.22186 11.6156 4.60982 11.5384C4.99778 11.4613 5.39992 11.5009 5.76537 11.6522C6.13082 11.8036 6.44318 12.06 6.66294 12.3889C6.8827 12.7178 7 13.1044 7 13.5C6.99934 14.0302 6.78841 14.5386 6.41348 14.9135C6.03855 15.2884 5.53023 15.4993 5 15.5ZM5 12.5C4.80222 12.5 4.60888 12.5587 4.44443 12.6685C4.27998 12.7784 4.15181 12.9346 4.07612 13.1173C4.00043 13.3 3.98063 13.5011 4.01922 13.6951C4.0578 13.8891 4.15304 14.0673 4.29289 14.2071C4.43275 14.347 4.61093 14.4422 4.80491 14.4808C4.99889 14.5194 5.19996 14.4996 5.38268 14.4239C5.56541 14.3482 5.72159 14.22 5.83147 14.0556C5.94135 13.8911 6 13.6978 6 13.5C5.99974 13.2349 5.89429 12.9807 5.70682 12.7932C5.51934 12.6057 5.26514 12.5003 5 12.5Z,M11 4.5C10.6044 4.5 10.2178 4.3827 9.88886 4.16294C9.55996 3.94318 9.30362 3.63082 9.15224 3.26537C9.00087 2.89992 8.96126 2.49778 9.03843 2.10982C9.1156 1.72186 9.30608 1.36549 9.58579 1.08579C9.86549 0.806082 10.2219 0.615601 10.6098 0.53843C10.9978 0.46126 11.3999 0.500867 11.7654 0.652242C12.1308 0.803617 12.4432 1.05996 12.6629 1.38886C12.8827 1.71776 13 2.10444 13 2.5C12.9993 3.03023 12.7884 3.53855 12.4135 3.91348C12.0386 4.28841 11.5302 4.49934 11 4.5ZM11 1.5C10.8022 1.5 10.6089 1.55865 10.4444 1.66853C10.28 1.77841 10.1518 1.93459 10.0761 2.11732C10.0004 2.30004 9.98063 2.50111 10.0192 2.69509C10.0578 2.88907 10.153 3.06726 10.2929 3.20711C10.4327 3.34696 10.6109 3.4422 10.8049 3.48079C10.9989 3.51937 11.2 3.49957 11.3827 3.42388C11.5654 3.34819 11.7216 3.22002 11.8315 3.05557C11.9414 2.89112 12 2.69778 12 2.5C11.9997 2.23487 11.8943 1.98067 11.7068 1.79319C11.5193 1.60571 11.2651 1.50027 11 1.5Z,M5 4.5C4.60444 4.5 4.21776 4.3827 3.88886 4.16294C3.55996 3.94318 3.30362 3.63082 3.15224 3.26537C3.00087 2.89992 2.96126 2.49778 3.03843 2.10982C3.1156 1.72186 3.30608 1.36549 3.58579 1.08579C3.86549 0.806082 4.22186 0.615601 4.60982 0.53843C4.99778 0.46126 5.39992 0.500867 5.76537 0.652242C6.13082 0.803617 6.44318 1.05996 6.66294 1.38886C6.8827 1.71776 7 2.10444 7 2.5C6.99934 3.03023 6.78841 3.53855 6.41348 3.91348C6.03855 4.28841 5.53023 4.49934 5 4.5ZM5 1.5C4.80222 1.5 4.60888 1.55865 4.44443 1.66853C4.27998 1.77841 4.15181 1.93459 4.07612 2.11732C4.00043 2.30004 3.98063 2.50111 4.01922 2.69509C4.0578 2.88907 4.15304 3.06726 4.29289 3.20711C4.43275 3.34696 4.61093 3.4422 4.80491 3.48079C4.99889 3.51937 5.19996 3.49957 5.38268 3.42388C5.56541 3.34819 5.72159 3.22002 5.83147 3.05557C5.94135 2.89112 6 2.69778 6 2.5C5.99974 2.23487 5.89429 1.98067 5.70682 1.79319C5.51934 1.60571 5.26514 1.50027 5 1.5Z'
};
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$("#navbarsubmit").click(function() {
    $('form#drawdetails').submit();
})
$('document').on("click", "#drawdetailsreset", function(){
    $('.clear').summernote('code', '<p><b></p>');
    $('.clearDescription').summernote('code', '<p><br></p>');
    $('#selectagegroup').val(null).trigger('change');
    $('#selecttag').val(null).trigger('change');
})
$('.drawdetailsreset').click(function (){
    $('.clear').summernote('code', '<p><b></p>');
    $('.clearDescription').summernote('code', '<p><br></p>');
    document.getElementById("drawdetails").reset();
    $('#selectagegroup').val(null).trigger('change');
    $('#selecttag').val(null).trigger('change');
    $('canvas').not(':first').remove();

})
function myfunction() {
    var selectedLine = $('.line-selection').select2('data');
    mode = selectedLine[0].id;
}
var data;
var ground = {
    "Basketball": [ 
        {
            "id":"basketball_court_one",
            "text":"Court 1"
        },
        {
            "id":"combocourtbb_basketball",
            "text":"Combo court"
        },
        {
            "id":"twohalfcrt_basketball",
            "text":"Two half"
        },
        {
            "id":"onehalfcrt_basketball",
            "text":"One half court"
        }
    ],
    "Volleball": [ 
        {
            "id":1,
            "text":"Select  ground"
        }
    ],
    "Soccer": [ 
        {
            "id":1,
            "text":"Select  ground"
        }
    ]
}
function selectsportdrill() {
    selectedSport = $('.sports-selection').select2('data');
    selectedSport = selectedSport[0].id;
    sessionStorage.setItem("selectedSport", selectedSport);
    $('.toolbox').css('display','none');
    $('.'+selectedSport).css('display','block');
    $('.Sketchpad-ground').css('display','block');
    if(selectedSport =="Default") {
        $('.Sketchpad-ground').css('display','none');
    }
   $(".ground-selection").empty();
    data = ground[selectedSport];
    $(".ground-selection").select2({
        data: data
    });  
}
function groundChange() {
    // selectedground = $('.ground-selection').select2('data');
    // selectedground = selectedground[0].id;
    // alert(selectedground);
    // sessionStorage.setItem("selectedground", selectedground);
    $(".tool").removeClass('selectedTool');
    $('.color-picker').css('display','none');
    $('.attacklist').css('display','none');
    $('.lines-option').css('display','none');
    $('.fontcontainer').css('display','none');
    courtDisplay();
}
if(lastsegment == "drills" || lastsegment == "drills#") {
    $(".ground-selection").empty();
    data = ground["Basketball"];
    $(".ground-selection").select2({
        data: data
    });
    groundChange();
}
$(".color-picker ul li").on("click", function(e) {
    if( mode == "Select") {
        var shape = selecteShape;
       //shape.style.Stroke = "orange";
       console.log(shape);
       $('#'+shape).css('display','none');
       console.log(e);
        // colorSelected = $(this).attr('id');
        // drawShapes(e);
        if(textarea == "undefined") {
        }
        else {
            $(textarea).css('display','none');
        }
        $('.color-indicator').css('background-color',colorSelected);
        $('.color-indicator').css('border-color',colorSelected);
    }
    else {
        colorSelected = $(this).attr('id');
        if(textarea == "undefined") {
        }
        else {
            $(textarea).css('display','none');
        }
        $('.color-indicator').css('background-color',colorSelected);
        $('.color-indicator').css('border-color',colorSelected);
    }
});
/*sketchpad text area focus*/
document.getElementsByTagName("textarea")[0].focus();
/*sketchpad text area focus*/
var ddData
if(lastsegment == "drills" || lastsegment == "drills#") {
    ddData = [
        {
            text: "straight Line",
            value: "arrow",
            selected: false,
            imageSrc: "assets/sketchpad/img/newline.svg"
        },
        {
            text: "wiggle Line",
            value: "wiggleline",
            selected: false,
            imageSrc: "assets/sketchpad/img/wiggleline.svg"
        },
        {
            text: "Free Line",
            value: "Freelinewitharrow",
            selected: false,
            imageSrc: "assets/sketchpad/img/curve.svg"
        }
    ];
}
else {
    ddData = [
        {
            text: "straight Line",
            value: "arrow",
            selected: false,
            imageSrc: "../assets/sketchpad/img/newline.svg"
        },
        {
            text: "wiggle Line",
            value: "wiggleline",
            selected: false,
            imageSrc: "../assets/sketchpad/img/wiggleline.svg"
        },
        {
            text: "Free Line",
            value: "Freelinewitharrow",
            selected: false,
            imageSrc: "../assets/sketchpad/img/curve.svg"
        }
    ];

}
$('#myDropdown').ddslick({
    data:ddData,
    width:300,
    selectText: "Select Line",
    imagePosition:"left",
    onSelected: function(selectedData){
        mode = selectedData.selectedData.value;
        if(arrowstatus == "noarrow")
        {
            if(mode == "arrow") {
                mode = "streightline";
            }
            if(mode == "Freelinewitharrow") {
                mode = "freeline";
            }
        }
        if(mode == "wiggleline") {
            $("#arrowoption").css('display','none');
        }
        if(mode != "wiggleline") {
            $("#arrowoption").css('display','block');
        }
    }   
});
var ddDataarrow
if(lastsegment == "drills" || lastsegment == "drills#") {
    ddDataarrow = [
    {
        text: "Direction",
        value: "arrow",
        selected: true,
        imageSrc: "assets/sketchpad/img/direction.svg"
    },
    {
        text: "No Arrowhead",
        value: "noarrow",
        selected: false,
        imageSrc: "assets/sketchpad/img/no_arrow.svg"
    }
];
}
else {
    ddDataarrow = [
    {
        text: "Direction",
        value: "arrow",
        selected: true,
        imageSrc: "../assets/sketchpad/img/direction.svg"
    },
    {
        text: "No Arrowhead",
        value: "noarrow",
        selected: false,
        imageSrc: "../assets/sketchpad/img/no_arrow.svg"
    }
];
}
$('#arrowoption').ddslick({
    data:ddDataarrow,
    width: 290,
    selectText: "Arrow",
    imagePosition:"left",
    onSelected: function(selectedData){
        arrowstatus = selectedData.selectedData.value;
        if(arrowstatus == "noarrow")
        {
            if(mode == "arrow") {
                mode = "streightline";
            }
            if(mode == "Freelinewitharrow") {
                mode = "freeline";
            }
        }
        if(arrowstatus == "arrow")
        {
            if(mode == "streightline") {
                mode = "arrow";
            }
            if(mode == "freeline") {
                mode = "Freelinewitharrow";
            }
        }
    }   
});
function selectfontsize() {
    Tsize = $('.font-selection').select2('data')[0].id;
    if(textarea == "undefined") {
    }
    else {
       $(textarea).css('display','none');
    }
}
$(".attacklist li").on("click", function(e) {
    if(textarea == "undefined") {
    }
    else {
       $(textarea).css('display','none');
    }
    mode = $(this).attr('id');
    $(".attacklistselection").removeClass('selectedTool');
    $(this).addClass("selectedTool");
    attacktype = $(this).attr('data-attacktype');
});
// $(".sports-selection").click(function(e) {
//     selectedSport = $(e.target).text();
//    $('.selectedsport').text(selectedSport);
//    $('.toolbox').css('display','none');
//     $('.'+selectedSport).css('display','block');
//     $('.Sketchpad-ground').css('display','block');
//     $(".ground-selection").empty();
//     data = ground[selectedSport];
//     $(".ground-selection").select2({
//         data: data
//     });
// });
$(document).on('click', '.tool-box-close', function() {
    $('.toolbox-container').addClass("toolbox_close");
    $('.open-close-button').empty();
    $('.open-left').removeClass('pl-140');
    $('.mr-25').css('display','none');
    $('.open-close-button').append('<span class="tool-box-open open-close-button edit-open">EDIT</span>');
});
$(document).on('click', '.tool-box-open', function() {
    $('.toolbox-container').removeClass("toolbox_close");
    $('.open-close-button').empty();
    $('.open-left').addClass('pl-140');
    $('.open-close-button').append('<span class="tool-box-close open-close-button">&lt;</span>');
});
$(document).on('click', '.drill-box-close', function() {
    $('.drill-sidebar').addClass("drill-box-closed");
    $('.open-close-button-drills').empty();
    $('.open-left').removeClass('pr-300');
    $('.open-close-button-drills').append('<span class="drill-box-open">DRILLS</span>');
});
$(document).on('click', '.drill-box-closed', function() {
    $('.drill-sidebar').removeClass("drill-box-closed");
    $('.open-left').addClass('pr-300');
    $('.open-close-button-drills').empty();
    $('.open-close-button-drills').append('<span class="drill-box-close">&gt;</span>');
});
$('.drill-save').click(function () {
    var drillname = $('.plantitle').val();
    $('#drillname').val(drillname);
    $('form#drawdetails').submit();
})
function selectmins() {
    mins = $('.minchange').select2('data');
    mins = mins[0].id;
    $('#mins').val(mins);
}
$(".sports-selection").click(function(e) {
    var surface = $(this).attr('id');
    $("#rink").val(surface);
});
if(lastsegment != "drills" || lastsegment != "drills#") {
    setTimeout(function(){
        var  savemins = $('.select-mins .select2-selection__rendered').text();
        $('#mins').val(savemins);
    }, 2000);
}
$('.text-alignment img').click(function(e){
    alignment = $(this).attr("data-align");
    if(textarea == "undefined") {
    }
    else {
       $(textarea).css('display','none');
    }
})
$(document).on('click', '.newdrill', function() {
    if(lastsegment != "drills" || lastsegment != "drills#") {
        window.location.href = '../drills';
    }
    if(lastsegment == "drills" || lastsegment == "drills#")  {
        location.reload();
    } 
});