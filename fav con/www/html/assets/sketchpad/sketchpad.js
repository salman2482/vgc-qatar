$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.font-selection').select2();
    $('.dd-container').addClass('lines-option mr-25');
});
var scroll = 0 ;
var colochangetype;
var textblurstatus;
var colorchangeshape;
var iconData;
var textNode;
var recreatetextnode = '';
var colorChangerStage;
var colorchangeX;
var colorchangeY;
var colorchangeId;
var colorchanger;
var stage; 
var colorSelected = "black";
var selectedground = "basketball_court_one";
var DtextCount = 1;
var textarea;
var arrowstatus;
var Tsize = 15;
var mins;
var selecteShape;
var alignment = "left";
var sketchpadData;
var sports = "Basketball";
var url =  window.location.href;
var array = url.split('/');
var lastsegment = array[array.length-1];
var selectedSport;
var json = $("#exampleFormControlTextarea1").val();
if(json.length == 0 ) {
    $("#rink").val("basketball_court_one");
    selectedSport = "Basketball";
    $('#sports').val("Basketball");
    // $('.selectedsport').removeAttr('disabled','disabled');
    // $('.ground-switch').removeAttr('disabled','disabled');
}
else {
    selectedground = $("#rink").val();
    open();
    selectedSport = $("#sports").val();
    // $('.selectedsport').text(selectedSport);
    // $('.selectedsport').attr('disabled','disabled');
    //$('.ground-switch').attr('disabled','disabled');
    $('.toolbox').css('display','none');
    $('.'+selectedSport).css('display','table');
    $('.'+selectedSport+'surface').css('display','block'); 
}
var myHistory = [];
myHistory[1] = 1;
var historyIndex = 0;
var width = 700;
var height = 400;
if(json.length == 0) {
    var court_details =  {
        "basketball_court_one" : [
            { "width":700,"Height":400 }
        ],
        "basketball_court_two" : [
            { "width":701,"Height":830 }
        ],
        "basketball_court_three" : [
            { "width":401,"Height":321 }
        ],
        "basketball_court_four" : [
            { "width":400,"Height":689 }
        ],
        "hockeycourt_one" : [
            { "width":327,"Height":329 }
        ],
        "hockeycourt_two" : [
            { "width":700,"Height":400 }
        ],
        "hockeycourt_three" : [
            { "width":329,"Height":327 }
        ],
        "hockeycourt_four" : [
            { "width":654,"Height":327 }
        ],
    }
    var court_width = court_details[selectedground][0].width;
    var court_Height = court_details[selectedground][0].Height;
    $('.ground').css('width',court_width);
    stage = new Konva.Stage({
        container: 'play-ground',
        width: court_width,
        height: court_Height,
    });
    stage.on('mousedown touchstart', function(e) {
        drawShapes(e);
        $("#undo").removeClass('disableclick');
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
    })
}
var courtlayer = new Konva.Layer();
function courtDisplay() {
    var courtlayer = new Konva.Layer();
    var court_details =  {
        "basketball_court_one" : [
            { "width":700,"Height":400 }
        ],
        "basketball_court_two" : [
            { "width":701,"Height":830 }
        ],
        "basketball_court_three" : [
            { "width":401,"Height":321 }
        ],
        "basketball_court_four" : [
            { "width":400,"Height":689 }
        ],
        "hockeycourt_one" : [
            { "width":327,"Height":329 }
        ],
        "hockeycourt_two" : [
            { "width":700,"Height":400 }
        ],
        "hockeycourt_three" : [
            { "width":329,"Height":327 }
        ],
        "hockeycourt_four" : [
            { "width":654,"Height":327 }
        ],
    }
    var court_width = court_details[selectedground][0].width;
    var court_Height = court_details[selectedground][0].Height;
    $('.ground').css('width',court_width);
    stage = new Konva.Stage({
        container: 'play-ground',
        width: court_width,
        height: court_Height,
    });
    stage.on('mousedown touchstart', function(e) {
        drawShapes(e);
        $("#undo").removeClass('disableclick');
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
    })
    if(json.length == 0) {
        Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
            courtlayer.add(imageNode);
            imageNode.setAttrs({
                width: court_width,
                height: court_Height,
            });
            courtlayer.batchDraw();
            stage.add(courtlayer);
        });
    }
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
}
var mode;
var attacktype;
$(".toolbox-container ul.newtools li").on("click", function(e) {
    colorchanger = 0;
    colorSelected = 'black';
    $('.color-indicator').css('background-color',colorSelected);
    $('.color-indicator').css('border-color',colorSelected);
    $(".attacklistselection").removeClass('selectedTool');
    // if(textarea == "undefined") {
    // }
    // else {
    //    $(textarea).css('display','none');
    // }
    mode = $(this).attr('id');
    if(mode == "Dtext") {

    }
    else {
       $(textarea).css('display','none');
    }
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
    if( mode != "delete" || mode != "undo" || mode != "redo" || mode != "Select") {
        $('.color-picker').css('display','block');
    }
    if( mode == "delete" || mode == "undo" || mode == "redo" || mode == "Select") {
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
    if( attacktype == "LW") {
        $('.lw').css('display','block');
    }
    if( attacktype != "LW") {
        $('.lw').css('display','none');
    }
    if( attacktype == "RW") {
        $('.rw').css('display','block');
    }
    if( attacktype != "RW") {
        $('.rw').css('display','none');
    }
    if( attacktype == "LD") {
        $('.ld').css('display','block');
    }
    if( attacktype != "LD") {
        $('.ld').css('display','none');
    }
    if( attacktype == "G") {
        $('.g').css('display','block');
    }
    if( attacktype != "G") {
        $('.g').css('display','none');
    }
    if( attacktype == "RD") {
        $('.rd').css('display','block');
    }
    if( attacktype != "RD") {
        $('.rd').css('display','none');
    }
    if( attacktype == "F") {
        $('.f').css('display','block');
    }
    if( attacktype != "F") {
        $('.f').css('display','none');
    }
    if( attacktype == "D") {
        $('.d').css('display','block');
    }
    if( attacktype != "D") {
        $('.d').css('display','none');
    }
   
    if( attacktype == "L") {
        $('.l').css('display','block');
    }
    if( attacktype != "L") {
        $('.l').css('display','none');
    }
    
    if( attacktype == "MB") {
        $('.mb').css('display','block');
    }
    if( attacktype != "MB") {
        $('.mb').css('display','none');
    }
    if( attacktype == "S") {
        $('.s').css('display','block');
    }
    if( attacktype != "S") {
        $('.s').css('display','none');
    }
    if( attacktype == "OUT H") {
        $('.h').css('display','block');
    }
    if( attacktype != "OUT H") {
        $('.h').css('display','none');
    }
    if( attacktype == "OPP H") {
        $('.opp').css('display','block');
    }
    if( attacktype != "OPP H") {
        $('.opp').css('display','none');
    }
    if( attacktype == "LB") {
        $('.lb').css('display','block');
    }
    if( attacktype != "LB") {
        $('.lb').css('display','none');
    }
    if( attacktype == "GK") {
        $('.gk').css('display','block');
    }
    if( attacktype != "GK") {
        $('.gk').css('display','none');
    }
     if( attacktype == "RB") {
        $('.rb').css('display','block');
    }
    if( attacktype != "RB") {
        $('.rb').css('display','none');
    }
     if( attacktype == "LWB") {
        $('.lwb').css('display','block');
    }
    if( attacktype != "LWB") {
        $('.lwb').css('display','none');
    }
     if( attacktype == "SW") {
        $('.sw').css('display','block');
    }
    if( attacktype != "SW") {
        $('.sw').css('display','none');
    }
     if( attacktype == "RWB") {
        $('.rwb').css('display','block');
    }
    if( attacktype != "RWB") {
        $('.rwb').css('display','none');
    }
     if( attacktype == "DM") {
        $('.dm').css('display','block');
    }
    if( attacktype != "DM") {
        $('.dm').css('display','none');
    }
     if( attacktype == "CM") {
        $('.cm').css('display','block');
    }
    if( attacktype != "CM") {
        $('.cm').css('display','none');
    }
     if( attacktype == "AM") {
        $('.am').css('display','block');
    }
    if( attacktype != "AM") {
        $('.am').css('display','none');
    }
     if( attacktype == "LM") {
        $('.lm').css('display','block');
    }
    if( attacktype != "LM") {
        $('.lm').css('display','none');
    }
     if( attacktype == "RM") {
        $('.rm').css('display','block');
    }
    if( attacktype != "RM") {
        $('.rm').css('display','none');
    }
     if( attacktype == "CF") {
        $('.cf').css('display','block');
    }
    if( attacktype != "CF") {
        $('.cf').css('display','none');
    }
     if( attacktype == "S") {
        $('.s').css('display','block');
    }
    if( attacktype != "S") {
        $('.s').css('display','none');
    }
     if( attacktype == "SS") {
        $('.ss').css('display','block');
    }
    if( attacktype != "SS") {
        $('.ss').css('display','none');
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
        historyIndex += 1;
        myHistory.push(stage.toJSON());
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)

    } else if (historyIndex > 1) {
        $("#redo").removeClass('disableclick');
        var z = myHistory[historyIndex];
        historyIndex -= 1;
        stage = Konva.Node.create(z, 'play-ground');
        var court_details =  {
        "basketball_court_one" : [
            { "width":700,"Height":400 }
        ],
        "basketball_court_two" : [
            { "width":701,"Height":830 }
        ],
        "basketball_court_three" : [
            { "width":401,"Height":321 }
        ],
        "basketball_court_four" : [
            { "width":400,"Height":689 }
        ],
        "hockeycourt_one" : [
            { "width":327,"Height":329 }
        ],
        "hockeycourt_two" : [
            { "width":700,"Height":400 }
        ],
        "hockeycourt_three" : [
            { "width":329,"Height":327 }
        ],
        "hockeycourt_four" : [
            { "width":654,"Height":327 }
        ],
    }
    var court_width = court_details[selectedground][0].width;
    var court_Height = court_details[selectedground][0].Height;
    $('.ground').css('width',court_width);
        if( lastsegment == "drills" || lastsegment == "drills#")  {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: court_width,
                        height: court_Height,
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
                        width: court_width,
                        height: court_Height,
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
    var court_details =  {
        "basketball_court_one" : [
            { "width":700,"Height":400 }
        ],
        "basketball_court_two" : [
            { "width":701,"Height":830 }
        ],
        "basketball_court_three" : [
            { "width":401,"Height":321 }
        ],
        "basketball_court_four" : [
            { "width":400,"Height":689 }
        ],
        "hockeycourt_one" : [
            { "width":327,"Height":329 }
        ],
        "hockeycourt_two" : [
            { "width":700,"Height":400 }
        ],
        "hockeycourt_three" : [
            { "width":329,"Height":327 }
        ],
        "hockeycourt_four" : [
            { "width":654,"Height":327 }
        ],
    }
    var court_width = court_details[selectedground][0].width;
    var court_Height = court_details[selectedground][0].Height;
    $('.ground').css('width',court_width);
    var undogroundlayer = new Konva.Layer();
    if( lastsegment == "drills" || lastsegment == "drills#")  {
            var undogroundlayer = new Konva.Layer();
            Konva.Image.fromURL('assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
                undogroundlayer.add(imageNode);
                    imageNode.setAttrs({
                        width: court_width,
                        height: court_Height,
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
                        width: court_width,
                        height: court_Height,
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
}
function open() {
    DtextCount = 1;
    var courtlayer = new Konva.Layer();
    var court_details =  {
        "basketball_court_one" : [
            { "width":700,"Height":400 }
        ],
        "basketball_court_two" : [
            { "width":701,"Height":830 }
        ],
        "basketball_court_three" : [
            { "width":401,"Height":321 }
        ],
        "basketball_court_four" : [
            { "width":400,"Height":689 }
        ],
        "hockeycourt_one" : [
            { "width":327,"Height":329 }
        ],
        "hockeycourt_two" : [
            { "width":700,"Height":400 }
        ],
        "hockeycourt_three" : [
            { "width":329,"Height":327 }
        ],
        "hockeycourt_four" : [
            { "width":654,"Height":327 }
        ],
    }
    var court_width = court_details[selectedground][0].width;
    var court_Height = court_details[selectedground][0].Height;
    $('.ground').css('width',court_width);
    stage = Konva.Node.create(json, 'play-ground');
       stage.on('mousedown touchstart', function(e) {
        //drawShapes(e);
        $("#undo").removeClass('disableclick');
        sketchpadData = stage.toJSON();
        $("#exampleFormControlTextarea1").val(sketchpadData)
    })
    var undogroundlayer = new Konva.Layer();
        Konva.Image.fromURL('../assets/sketchpad/img/'+selectedground+'.svg', (imageNode) => {
            undogroundlayer.add(imageNode);
                imageNode.setAttrs({
                    width: court_width,
                    height: court_Height,
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
    iconData = icons[attacktype];
    stage;
    if(colorchanger != 1) {
        stage = e.currentTarget;
    }
    else if( colorchanger == 1 ) {
         if (mode == "svgicon") {
            mode = "icon";
         }
         else if (mode == "attack") {
            mode = "attack";
         }
         stage = colorChangerStage;

    }
    // if(deleteShapeId != "") {
    //     var hideshape = stage.find('#' + deleteShapeId);
    //     hideshape.hide();
    //     layer.draw();
    //     stage.add(layer);
    //     deleteShapeId='';
    // }
    if (colorchanger == 1 || stage.attrs.container.id == "play-ground") {
        isPaint = true;
        var pos;
        if(colorchanger != 1) {
            pos = stage.getPointerPosition();
        }
        else {
            // pos[x] = colorchangeX;
            // pos[y] = colorchangeY;
            var layer = new Konva.Layer();
            pos = { x: colorchangeX, y: colorchangeY};
            colorchangeshape = stage.find('#' + colorchangeId);
            colorchangeshape.hide();
            console.log(colorchangeshape);
            if( lastsegment == "drills" || "drills#") {
                var c = document.getElementById(colorchangeId);
                if (  c == null) {
                    //alert("null");
                }
                else {
                    c.remove();
                }
            }
        }
        $('.konvajs-content').css('cursor', 'pointer');
        if( mode == "Select") {
            //var shapetype = e.target.attrs.id || e.currentTarget.clickEndShape.attrs.id || e.currentTarget.children[0].children[0].attrs.id;
            //console.log(shapetype);
            // console.log(e);
            // console.log(e.target.attrs.iconname);
            colochangetype = e.target.attrs.type;
            if(e.target.attrs.type == "svgicon") {
               $('.color-picker').css('display','block');
                colorchangeX = e.target.attrs.x+1;
                colorchangeY = e.target.attrs.y+1;
                colorchangeId = e.target.attrs.id;
                attacktype =  e.target.attrs.iconname;
                colorChangerStage = e.currentTarget;
                iconData = icons[e.target.attrs.iconname];
               // pos = { x: colorchangeX, y: colorchangeY};
            }
            if(e.target.attrs.type == "sf") {
               $('.color-picker').css('display','block');
                colorchangeX = e.target.attrs.xaxis+1;
                colorchangeY = e.target.attrs.yaxis+1;
                colorchangeId = e.target.attrs.id;
                console.log(e.target.attrs);
                attacktype = e.target.attrs.text;
                colorChangerStage = e.currentTarget;
               // pos = { x: colorchangeX, y: colorchangeY};
            }
            // $('.color-indicator').css('background-color',e.target.attrs.stroke);
            // $('.color-indicator').css('border-color',e.target.attrs.stroke);

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
                        id: pos.x + pos.y + "streightline",
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
                    strokeWidth: 2,
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
        var  rectangle = new Konva.Rect({
                x: pos.x,
                y: pos.y,
                fill: 'white',
                stroke: colorSelected,
                strokeWidth: 2,
                draggable: true,
                angle: 60,
                width: 12,
                id: pos.x + pos.y + "rect",
                height: 12,
                type: 'rectangle',
                hitFunc: function (context) {
                    context.beginPath();
                }
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
                type:'sf',
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
                    type:'sf',
                    xaxis: pos.x,
                    yaxis:pos.y
                })
            );
            layer.add(tooltip);
            stage.add(layer);
            $('canvas').last().attr("id", pos.x + pos.y + "attack");
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
                iconname: attacktype,
                type:'svgicon'
            });
            var h = "123";
            layer.add(path);
            layer.id(pos.x + pos.y + "icon");
            stage.add(layer);
            $('canvas').last().attr("id", pos.x + pos.y + "icon");
            //sketchpadData = stage.toJSON();
        } else if (mode == "Dtext") {
            if( DtextCount % 2 == 1 ) {
                    textNode = new Konva.Text({
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
                var scrollposition = 0;
                if(scroll> 80){
                    scrollposition = scroll+10/2;
                }
                textarea.style.textAlign = alignment;
                textarea.style.top = areaPosition.y + scrollposition + 5 + 'px';
                textarea.style.left = areaPosition.x + 'px';
                textarea.style.width = textNode.width();
                $(textarea).on('focus', function(e) {
                    console.log("hello");
                    textarea.value.fontSize = Tsize+'px';
                    textarea.style.textAlign = alignment;
                    textarea.style.fontSize = Tsize+'px';
                    textarea.style.color = colorSelected;
                    textNode.text(textarea.value);
                });
                $(textarea).on('blur', function(e) {
                    //textNode.attrs.textAlign = alignment;
                    //textNode.attrs.fontSize = Tsize+'px';
                    //textNode.attrs.color = colorSelected;
                    if(scroll> 80){
                        scrollposition = scroll+10/2;
                    }
                    textarea.style.textAlign = alignment;
                    textarea.style.top = areaPosition.y + scrollposition + 5 + 'px';
                    textarea.style.top = areaPosition.y - 0 + 'px';
                    textNode.attrs.fontSize = Tsize;
                    textNode.attrs.textAlign = alignment;
                    //textNode.attrs.fontSize = Tsize+'px';
                    //textareastart;
                    textNode.attrs.fill = colorSelected;
                    textNode.attrs.fontSize = Tsize;
                    textNode.attrs.textAlign = alignment;
                    textNode.text(textarea.value);
                    //textNode.color(textarea.color);
                    recreatetextnode = textNode.attrs;
                    layer.draw();
                });
            }
            else {
                //alert(DtextCount);
                if( DtextCount  == 2 ) {
                    var textnewNode = new Konva.Text({
                        text: recreatetextnode.text,
                        x: recreatetextnode.x+70,
                        y: recreatetextnode.y,
                        fontSize: Tsize,
                        id: recreatetextnode.id,
                        fill: colorSelected,
                        draggable: true,
                    });
                    layer.add(textnewNode);
                    stage.add(layer);
                    document.body.removeChild(textarea);
                    recreatetextnode = '';
                    if(recreatetextnode.text !=''){
                        $("canvas").last().remove();
                    }
                }
                else if( DtextCount % 2 == 0 ) {
                    console.log(recreatetextnode);
                    var textnewNode = new Konva.Text({
                        text: recreatetextnode.text,
                        x: recreatetextnode.x+70,
                        y: recreatetextnode.y,
                        fontSize: Tsize,
                        id: recreatetextnode.id,
                        fill: colorSelected,
                        draggable: true,
                    });
                    layer.add(textnewNode);
                    stage.add(layer);
                    document.body.removeChild(textarea);
                    recreatetextnode = '';
                    if(recreatetextnode.text !=''){
                        $("canvas").last().remove();
                    }

                }
                else if( DtextCount == 1 ) {
                    console.log(recreatetextnode);
                    var textnewNode = new Konva.Text({
                        text: recreatetextnode.text,
                        x: recreatetextnode.x+70,
                        y: recreatetextnode.y,
                        fontSize: Tsize,
                        id: recreatetextnode.id,
                        fill: colorSelected,
                        draggable: true,
                    });
                    layer.add(textnewNode);
                    stage.add(layer);
                    document.body.removeChild(textarea);
                    recreatetextnode = '';
                    if(recreatetextnode.text !=''){
                        $("canvas").last().remove();
                    }

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
    "cone": "M12.9999 16.1566C15.7385 16.1566 18.0325 15.1189 18.1711 13.7631L16.8821 9.73514C16.5795 10.7076 14.9055 11.3977 12.9999 11.3977C11.0944 11.3977 9.42029 10.7076 9.11779 9.73514L7.82985 13.7631C7.9685 15.1189 10.2613 16.1566 12.9999 16.1566V16.1566ZM12.9999 7.58827C14.2879 7.58827 15.483 7.14356 15.8336 6.45221C15.3512 4.94173 14.9375 3.64466 14.6752 2.82808C14.501 2.28242 13.7115 2 12.9999 2C12.2883 2 11.4989 2.28242 11.3247 2.82808L10.1662 6.45221C10.5169 7.14356 11.7131 7.58827 12.9999 7.58827V7.58827ZM23.0605 17.4192L18.7578 15.4844L19.254 17.0268C19.2288 18.6613 16.3848 19.9647 12.9999 19.9647C9.61623 19.9647 6.76995 18.6626 6.74588 17.0268L7.24203 15.4844L2.93938 17.4192C1.7328 17.961 1.68123 18.9641 2.82708 19.6478L10.9191 24.4872C12.0626 25.1709 13.9361 25.1709 15.0808 24.4872L23.1739 19.6478C24.3186 18.9641 24.267 17.961 23.0605 17.4192Z",
    "camera": 'M18.1481 2.61539H15L14.25 0.495055C14.1982 0.349967 14.1032 0.224554 13.9781 0.135948C13.853 0.0473417 13.7038 -0.000136051 13.5509 2.92836e-07H6.44907C6.13657 2.92836e-07 5.85648 0.198489 5.75231 0.495055L5 2.61539H1.85185C0.828704 2.61539 0 3.45137 0 4.48352V15.1319C0 16.164 0.828704 17 1.85185 17H18.1481C19.1713 17 20 16.164 20 15.1319V4.48352C20 3.45137 19.1713 2.61539 18.1481 2.61539ZM10 13.2637C7.9537 13.2637 6.2963 11.5918 6.2963 9.52747C6.2963 7.46319 7.9537 5.79121 10 5.79121C12.0463 5.79121 13.7037 7.46319 13.7037 9.52747C13.7037 11.5918 12.0463 13.2637 10 13.2637ZM7.77778 9.52747C7.77778 10.122 8.0119 10.6922 8.42865 11.1126C8.8454 11.533 9.41063 11.7692 10 11.7692C10.5894 11.7692 11.1546 11.533 11.5713 11.1126C11.9881 10.6922 12.2222 10.122 12.2222 9.52747C12.2222 8.93292 11.9881 8.36272 11.5713 7.94231C11.1546 7.5219 10.5894 7.28571 10 7.28571C9.41063 7.28571 8.8454 7.5219 8.42865 7.94231C8.0119 8.36272 7.77778 8.93292 7.77778 9.52747Z',
    "close_x": "M18.5625 3.1338L15.9909 0.5625L9.5625 6.9912L3.1338 0.5625L0.5625 3.1338L6.9909 9.5625L0.5625 15.9912L3.1338 18.5625L9.5625 12.1338L15.9909 18.5625L18.5625 15.9912L12.1335 9.5625L18.5625 3.1338Z",
    "hoop": 'M16.3636 0H1.63636C1.20237 0 0.786158 0.180612 0.47928 0.502103C0.172402 0.823594 0 1.25963 0 1.71429V12C0 12.4547 0.172402 12.8907 0.47928 13.2122C0.786158 13.5337 1.20237 13.7143 1.63636 13.7143H4.55727L5.72727 18L7.36364 16.2857L9 18L10.6364 16.2857L12.2727 18L13.4427 13.7143H16.3636C16.7976 13.7143 17.2138 13.5337 17.5207 13.2122C17.8276 12.8907 18 12.4547 18 12V1.71429C18 1.25963 17.8276 0.823594 17.5207 0.502103C17.2138 0.180612 16.7976 0 16.3636 0ZM16.3636 12H13.9091V10.2857H13.0909V6C13.0909 5.54534 12.9185 5.10931 12.6116 4.78782C12.3048 4.46633 11.8885 4.28571 11.4545 4.28571H6.54545C6.11146 4.28571 5.69525 4.46633 5.38837 4.78782C5.08149 5.10931 4.90909 5.54534 4.90909 6V10.2857H4.09091V12H1.63636V1.71429H16.3636V12ZM6.54545 10.2857V6H11.4545V10.2857H6.54545Z',
    "4_ball_track": 'M14 14C13.6044 14 13.2178 14.1173 12.8889 14.3371C12.56 14.5568 12.3036 14.8692 12.1522 15.2346C12.0009 15.6001 11.9613 16.0022 12.0384 16.3902C12.1156 16.7781 12.3061 17.1345 12.5858 17.4142C12.8655 17.6939 13.2219 17.8844 13.6098 17.9616C13.9978 18.0387 14.3999 17.9991 14.7654 17.8478C15.1308 17.6964 15.4432 17.44 15.6629 17.1111C15.8827 16.7822 16 16.3956 16 16C15.9994 15.4698 15.7885 14.9614 15.4135 14.5865C15.0386 14.2115 14.5302 14.0006 14 14V14ZM15.7071 15.8571H14.8629C14.8987 15.4875 15.0338 15.1344 15.254 14.8353C15.5155 15.1153 15.6752 15.4753 15.7071 15.8571ZM14.1429 15.8571V14.2929C14.4695 14.3201 14.7814 14.441 15.041 14.6411C14.7737 14.994 14.6128 15.4159 14.5771 15.8571H14.1429ZM13.8571 15.8571H13.4229C13.3872 15.4159 13.2263 14.994 12.959 14.6411C13.2186 14.4411 13.5305 14.3202 13.8571 14.293V15.8571ZM13.8571 16.1429V17.7071C13.5305 17.6799 13.2186 17.559 12.959 17.3589C13.2263 17.006 13.3872 16.5841 13.4229 16.1429H13.8571ZM14.1429 16.1429H14.5771C14.6128 16.5841 14.7738 17.006 15.0411 17.3589C14.7815 17.559 14.4696 17.6799 14.1429 17.707V16.1429ZM12.7457 14.8353C12.966 15.1344 13.1013 15.4874 13.1371 15.8571H12.293C12.3249 15.4753 12.4844 15.1154 12.7459 14.8353H12.7457ZM12.2929 16.1429H13.1371C13.1013 16.5125 12.9662 16.8656 12.746 17.1647C12.4845 16.8847 12.3248 16.5247 12.2929 16.1429V16.1429ZM15.2543 17.1647C15.034 16.8656 14.8987 16.5126 14.8629 16.1429H15.7069C15.675 16.5247 15.5154 16.8846 15.254 17.1647H15.2543Z,M9 14C8.60444 14 8.21776 14.1173 7.88886 14.3371C7.55996 14.5568 7.30362 14.8692 7.15224 15.2346C7.00087 15.6001 6.96126 16.0022 7.03843 16.3902C7.1156 16.7781 7.30608 17.1345 7.58579 17.4142C7.86549 17.6939 8.22186 17.8844 8.60982 17.9616C8.99778 18.0387 9.39992 17.9991 9.76537 17.8478C10.1308 17.6964 10.4432 17.44 10.6629 17.1111C10.8827 16.7822 11 16.3956 11 16C10.9994 15.4698 10.7885 14.9614 10.4135 14.5865C10.0386 14.2115 9.53025 14.0006 9 14V14ZM10.7071 15.8571H9.86286C9.89867 15.4875 10.0338 15.1344 10.254 14.8353C10.5155 15.1153 10.6752 15.4753 10.7071 15.8571ZM9.14286 15.8571V14.2929C9.46952 14.3201 9.78139 14.441 10.041 14.6411C9.7737 14.994 9.61277 15.4159 9.57714 15.8571H9.14286ZM8.85714 15.8571H8.42286C8.38723 15.4159 8.2263 14.994 7.959 14.6411C8.21863 14.4411 8.53049 14.3202 8.85714 14.293V15.8571ZM8.85714 16.1429V17.7071C8.53048 17.6799 8.21861 17.559 7.959 17.3589C8.2263 17.006 8.38723 16.5841 8.42286 16.1429H8.85714ZM9.14286 16.1429H9.57714C9.61281 16.5841 9.7738 17.006 10.0411 17.3589C9.78148 17.559 9.46956 17.6799 9.14286 17.707V16.1429ZM7.74572 14.8353C7.966 15.1344 8.10125 15.4874 8.13714 15.8571H7.293C7.3249 15.4753 7.48442 15.1154 7.74586 14.8353H7.74572ZM7.29286 16.1429H8.13714C8.10134 16.5125 7.96618 16.8656 7.746 17.1647C7.48446 16.8847 7.32484 16.5247 7.29286 16.1429V16.1429ZM10.2543 17.1647C10.034 16.8656 9.89875 16.5126 9.86286 16.1429H10.7069C10.675 16.5247 10.5154 16.8846 10.254 17.1647H10.2543Z,M9 8C8.60444 8 8.21776 8.1173 7.88886 8.33706C7.55996 8.55682 7.30362 8.86918 7.15224 9.23463C7.00087 9.60009 6.96126 10.0022 7.03843 10.3902C7.1156 10.7781 7.30608 11.1345 7.58579 11.4142C7.86549 11.6939 8.22186 11.8844 8.60982 11.9616C8.99778 12.0387 9.39992 11.9991 9.76537 11.8478C10.1308 11.6964 10.4432 11.44 10.6629 11.1111C10.8827 10.7822 11 10.3956 11 10C10.9994 9.46975 10.7885 8.9614 10.4135 8.58645C10.0386 8.21151 9.53025 8.0006 9 8V8ZM10.7071 9.85714H9.86286C9.89867 9.48747 10.0338 9.13438 10.254 8.83529C10.5155 9.11534 10.6752 9.47529 10.7071 9.85714ZM9.14286 9.85714V8.29286C9.46952 8.32007 9.78139 8.44101 10.041 8.64114C9.7737 8.99401 9.61277 9.4159 9.57714 9.85714H9.14286ZM8.85714 9.85714H8.42286C8.38723 9.4159 8.2263 8.99401 7.959 8.64114C8.21863 8.44106 8.53049 8.32017 8.85714 8.293V9.85714ZM8.85714 10.1429V11.7071C8.53048 11.6799 8.21861 11.559 7.959 11.3589C8.2263 11.006 8.38723 10.5841 8.42286 10.1429H8.85714ZM9.14286 10.1429H9.57714C9.61281 10.5841 9.7738 11.006 10.0411 11.3589C9.78148 11.559 9.46956 11.6799 9.14286 11.707V10.1429ZM7.74572 8.83529C7.966 9.13435 8.10125 9.48745 8.13714 9.85714H7.293C7.3249 9.47533 7.48442 9.11538 7.74586 8.83529H7.74572ZM7.29286 10.1429H8.13714C8.10134 10.5125 7.96618 10.8656 7.746 11.1647C7.48446 10.8847 7.32484 10.5247 7.29286 10.1429V10.1429ZM10.2543 11.1647C10.034 10.8656 9.89875 10.5126 9.86286 10.1429H10.7069C10.675 10.5247 10.5154 10.8846 10.254 11.1647H10.2543Z,M14 8C13.6044 8 13.2178 8.1173 12.8889 8.33706C12.56 8.55682 12.3036 8.86918 12.1522 9.23463C12.0009 9.60009 11.9613 10.0022 12.0384 10.3902C12.1156 10.7781 12.3061 11.1345 12.5858 11.4142C12.8655 11.6939 13.2219 11.8844 13.6098 11.9616C13.9978 12.0387 14.3999 11.9991 14.7654 11.8478C15.1308 11.6964 15.4432 11.44 15.6629 11.1111C15.8827 10.7822 16 10.3956 16 10C15.9994 9.46975 15.7885 8.9614 15.4135 8.58645C15.0386 8.21151 14.5302 8.0006 14 8V8ZM15.7071 9.85714H14.8629C14.8987 9.48747 15.0338 9.13438 15.254 8.83529C15.5155 9.11534 15.6752 9.47529 15.7071 9.85714ZM14.1429 9.85714V8.29286C14.4695 8.32007 14.7814 8.44101 15.041 8.64114C14.7737 8.99401 14.6128 9.4159 14.5771 9.85714H14.1429ZM13.8571 9.85714H13.4229C13.3872 9.4159 13.2263 8.99401 12.959 8.64114C13.2186 8.44106 13.5305 8.32017 13.8571 8.293V9.85714ZM13.8571 10.1429V11.7071C13.5305 11.6799 13.2186 11.559 12.959 11.3589C13.2263 11.006 13.3872 10.5841 13.4229 10.1429H13.8571ZM14.1429 10.1429H14.5771C14.6128 10.5841 14.7738 11.006 15.0411 11.3589C14.7815 11.559 14.4696 11.6799 14.1429 11.707V10.1429ZM12.7457 8.83529C12.966 9.13435 13.1013 9.48745 13.1371 9.85714H12.293C12.3249 9.47533 12.4844 9.11538 12.7459 8.83529H12.7457ZM12.2929 10.1429H13.1371C13.1013 10.5125 12.9662 10.8656 12.746 11.1647C12.4845 10.8847 12.3248 10.5247 12.2929 10.1429V10.1429ZM15.2543 11.1647C15.034 10.8656 14.8987 10.5126 14.8629 10.1429H15.7069C15.675 10.5247 15.5154 10.8846 15.254 11.1647H15.2543Z,M10 1C9.60444 1 9.21776 1.1173 8.88886 1.33706C8.55996 1.55682 8.30362 1.86918 8.15224 2.23463C8.00087 2.60009 7.96126 3.00222 8.03843 3.39018C8.1156 3.77814 8.30608 4.13451 8.58579 4.41421C8.86549 4.69392 9.22186 4.8844 9.60982 4.96157C9.99778 5.03874 10.3999 4.99913 10.7654 4.84776C11.1308 4.69638 11.4432 4.44004 11.6629 4.11114C11.8827 3.78224 12 3.39556 12 3C11.9994 2.46975 11.7885 1.9614 11.4135 1.58645C11.0386 1.21151 10.5302 1.0006 10 1V1ZM11.7071 2.85714H10.8629C10.8987 2.48747 11.0338 2.13438 11.254 1.83529C11.5155 2.11534 11.6752 2.47529 11.7071 2.85714ZM10.1429 2.85714V1.29286C10.4695 1.32007 10.7814 1.44101 11.041 1.64114C10.7737 1.99401 10.6128 2.4159 10.5771 2.85714H10.1429ZM9.85714 2.85714H9.42286C9.38723 2.4159 9.2263 1.99401 8.959 1.64114C9.21863 1.44106 9.53049 1.32017 9.85714 1.293V2.85714ZM9.85714 3.14286V4.70714C9.53048 4.67993 9.21861 4.55899 8.959 4.35886C9.2263 4.00599 9.38723 3.5841 9.42286 3.14286H9.85714ZM10.1429 3.14286H10.5771C10.6128 3.58412 10.7738 4.006 11.0411 4.35886C10.7815 4.55897 10.4696 4.67985 10.1429 4.707V3.14286ZM8.74572 1.83529C8.966 2.13435 9.10125 2.48745 9.13714 2.85714H8.293C8.3249 2.47533 8.48442 2.11538 8.74586 1.83529H8.74572ZM8.29286 3.14286H9.13714C9.10134 3.51253 8.96618 3.86562 8.746 4.16471C8.48446 3.88466 8.32484 3.52471 8.29286 3.14286V3.14286ZM11.2543 4.16471C11.034 3.86565 10.8987 3.51255 10.8629 3.14286H11.7069C11.675 3.52467 11.5154 3.88462 11.254 4.16471H11.2543Z,M4.5 22C5.88071 22 7 17.7467 7 12.5C7 7.25329 5.88071 3 4.5 3C3.11929 3 2 7.25329 2 12.5C2 17.7467 3.11929 22 4.5 22Z,M19.5 22C20.8807 22 22 17.7467 22 12.5C22 7.25329 20.8807 3 19.5 3C18.1193 3 17 7.25329 17 12.5C17 17.7467 18.1193 22 19.5 22Z,M19.9997 7C20.5537 7 21 6.77594 21 6.4996V5.5004C21 5.22406 20.5537 5 19.9997 5H6.00025C5.44735 5 5 5.22406 5 5.5004V6.4996C5 6.77647 5.44735 7 6.00025 7H19.9997V7Z,M19.9997 14C20.5537 14 21 13.7759 21 13.4996V12.5004C21 12.2241 20.5537 12 19.9997 12H6.00025C5.44735 12 5 12.2241 5 12.5004V13.4996C5 13.7765 5.44735 14 6.00025 14H19.9997V14Z,M19.9997 20C20.5537 20 21 19.7759 21 19.4996V18.5004C21 18.2241 20.5537 18 19.9997 18H6.00025C5.44735 18 5 18.2241 5 18.5004V19.4996C5 19.7765 5.44735 20 6.00025 20H19.9997V20Z',
    "copyright": 'M9.5 2C4.89215 2 1 5.893 1 10.5C1 15.107 4.89215 19 9.5 19C14.1079 19 18 15.107 18 10.5C18 5.893 14.1079 2 9.5 2ZM9.5 13.05C10.3432 13.05 11.0725 12.8248 11.4491 12.4482L12.651 13.651C11.6939 14.6072 10.2659 14.75 9.5 14.75C7.15655 14.75 5.25 12.8435 5.25 10.5C5.25 8.15655 7.15655 6.25 9.5 6.25C10.2659 6.25 11.6947 6.3928 12.651 7.34905L11.4491 8.55095C11.0734 8.1744 10.3441 7.95 9.5 7.95C8.1179 7.95 6.95 9.1179 6.95 10.5C6.95 11.8821 8.1179 13.05 9.5 13.05Z',
    "v_ball": 'M14.3875 3.6125C16.8113 7.14 15.9158 11.963 12.3875 14.3875C8.86 16.8112 4.037 15.9155 1.6125 12.3875C-0.811 8.86 0.0847502 4.0345 3.6125 1.6125C7.14 -0.8105 11.9655 0.0852501 14.3875 3.6125,M11.331 14.9965C11.331 14.9965 7.631 6.7515 11.5728 1.121L11.903 1.3035C11.903 1.3035 7.77375 6.96 12.1153 14.573L11.331 14.9955,M1.6115 12.3872C1.6115 12.3872 5.25825 6.97225 4.25225 1.216L3.80375 1.5245C3.80375 1.5245 5.7725 3.13125 1.3305 11.978,M8.63975 0.28525C8.63975 0.28525 4.131 5.93175 5.05725 15.1853C5.05725 15.1853 5.72725 15.384 5.9435 15.4607C6.15925 15.537 4.505 7.07825 9.3195 0.36325L8.6395 0.285,M0.42 6.7435C0.42 6.7435 6.28075 10.971 15.4785 9.59325C15.4785 9.59325 15.644 8.91425 15.7098 8.69475C15.7758 8.475 7.408 10.5417 0.46425 6.061L0.41925 6.7435',
    "rebound":'M3.92501 2.93896C4.46349 2.93896 4.90001 2.50491 4.90001 1.96948C4.90001 1.43405 4.46349 1 3.92501 1C3.38653 1 2.95001 1.43405 2.95001 1.96948C2.95001 2.50491 3.38653 2.93896 3.92501 2.93896Z,M1 11.9551L1.26 5.8474C1.2925 4.94255 2.04 4.2316 2.95 4.2316H4.9C5.81 4.2316 6.5575 4.94255 6.59 5.8474C6.59 5.8474 6.6225 8.01257 6.6875 8.85278C6.8175 10.4363 7.5 11.9551 7.5 11.9551,M5.54998 6.17056C4.76998 7.30162 5.32248 8.14184 5.54998 8.75584C5.71248 9.17595 5.80998 10.1131 5.84248 10.5655C6.03748 12.5045 6.16748 18.386 6.16748 18.386C6.19998 18.7415 5.93998 18.9677 5.67998 18.9677C5.41998 18.9677 5.22498 18.7738 5.19248 18.5476L4.31498 11.018C4.28248 10.8241 4.15248 10.6625 3.92498 10.6625C3.69748 10.6625 3.56748 10.8241 3.53498 11.018L2.65748 18.5476C2.62498 18.7738 2.42998 18.9677 2.16998 18.9677C1.90998 18.9677 1.64998 18.7415 1.68248 18.386C1.68248 18.386 1.84498 12.5368 2.03998 10.6302C2.07248 10.1454 2.16998 9.20826 2.29998 8.72352C2.49498 8.10952 3.07998 7.20467 2.29998 6.13824,M11.075 2.93896C11.6135 2.93896 12.05 2.50491 12.05 1.96948C12.05 1.43405 11.6135 1 11.075 1C10.5365 1 10.1 1.43405 10.1 1.96948C10.1 2.50491 10.5365 2.93896 11.075 2.93896Z,M7.5 11.9551C7.5 11.9551 8.1825 10.4363 8.3125 8.85278C8.3775 8.04488 8.41 5.8474 8.41 5.8474C8.4425 4.94255 9.19 4.2316 10.1 4.2316H12.05C12.96 4.2316 13.7075 4.94255 13.74 5.8474L14 11.9551,M12.7 6.17056C11.92 7.23698 12.505 8.14183 12.7 8.75583C12.8625 9.20826 12.9275 10.1777 12.96 10.6625C13.155 12.5691 13.3175 18.4183 13.3175 18.4183C13.35 18.7738 13.09 19 12.83 19C12.57 19 12.375 18.8061 12.3425 18.5799L11.465 11.0503C11.4325 10.8564 11.3025 10.6948 11.075 10.6948C10.8475 10.6948 10.7175 10.8564 10.685 11.0503L9.8075 18.5799C9.775 18.8061 9.58 19 9.32 19C9.06 19 8.8 18.7738 8.8325 18.4183C8.8325 18.4183 8.9625 12.5368 9.1575 10.5978C9.19 10.1454 9.2875 9.20826 9.45 8.78815C9.645 8.17415 10.1975 7.33393 9.45 6.20287,M4.30252 12.0388C4.29377 12.0388 4.28502 12.0375 4.27627 12.0363C4.19627 12.0213 4.14377 11.9413 4.15752 11.8575C4.79252 8.15251 6.02627 5.88251 6.03877 5.86001C6.04788 5.8427 6.06043 5.82743 6.07565 5.81514C6.09087 5.80285 6.10844 5.79379 6.12728 5.78852C6.14612 5.78326 6.16583 5.78189 6.18522 5.78451C6.20461 5.78713 6.22325 5.79368 6.24002 5.80376C6.31002 5.84626 6.33502 5.94126 6.29377 6.01501C6.28127 6.03626 5.07252 8.26501 4.44752 11.9125C4.43377 11.9863 4.37127 12.0388 4.30252 12.0388Z,M5.88251 12.0388C5.87376 12.0388 5.86501 12.0375 5.85626 12.0363C5.77626 12.0213 5.72376 11.9413 5.73751 11.8575C6.37251 8.15251 7.60626 5.88251 7.61876 5.86001C7.62787 5.8427 7.64042 5.82743 7.65564 5.81514C7.67086 5.80285 7.68842 5.79379 7.70726 5.78852C7.7261 5.78326 7.74582 5.78189 7.76521 5.78451C7.78459 5.78713 7.80324 5.79368 7.82001 5.80376C7.89001 5.84626 7.91501 5.94126 7.87376 6.01501C7.86126 6.03626 6.65251 8.26501 6.02751 11.9125C6.01501 11.9863 5.95251 12.0388 5.88251 12.0388Z,M7.42126 12.0388C7.41251 12.0388 7.40376 12.0375 7.39501 12.0363C7.31501 12.0213 7.26126 11.9413 7.27626 11.8575C7.91126 8.15375 9.08501 5.885 9.09751 5.8625C9.13626 5.7875 9.22626 5.76 9.29751 5.80125C9.36876 5.8425 9.39501 5.93625 9.35626 6.01125C9.34501 6.03375 8.19251 8.2625 7.56751 11.9125C7.55251 11.9863 7.49001 12.0388 7.42126 12.0388V12.0388Z,',
    "volleynet":'M5.82626 12.0388C5.75626 12.0388 5.69501 11.9863 5.68126 11.9113C5.05626 8.26376 3.84751 6.03501 3.83501 6.01376C3.79501 5.94001 3.81876 5.84501 3.88876 5.80251C3.95876 5.76001 4.04877 5.78501 4.09002 5.85876C4.10252 5.88126 5.33626 8.15126 5.97126 11.8563C5.98501 11.94 5.93251 12.02 5.85251 12.035C5.84376 12.0388 5.83501 12.0388 5.82626 12.0388V12.0388Z,M7.42001 12.0388C7.35001 12.0388 7.28876 11.9863 7.27501 11.9113C6.65001 8.26376 5.44126 6.03501 5.42876 6.01376C5.38876 5.94001 5.41251 5.84501 5.48251 5.80251C5.55251 5.76001 5.64252 5.78501 5.68377 5.85876C5.69627 5.88126 6.93001 8.15126 7.56501 11.8563C7.57876 11.94 7.52626 12.02 7.44626 12.035C7.43751 12.0388 7.42876 12.0388 7.42001 12.0388V12.0388Z,M8.88126 12.0388C8.81126 12.0388 8.74876 11.9863 8.73626 11.9113C8.11126 8.26376 6.90251 6.03501 6.89001 6.01376C6.85001 5.94001 6.87376 5.84501 6.94376 5.80251C7.01376 5.76001 7.10376 5.78501 7.14501 5.85876C7.15751 5.88126 8.39126 8.15126 9.02501 11.8563C9.04001 11.94 8.98626 12.02 8.90626 12.035C8.89876 12.0388 8.88876 12.0388 8.88126 12.0388V12.0388Z,M2.82876 12.0388C2.82001 12.0388 2.81126 12.0375 2.80251 12.0363C2.72251 12.0213 2.66876 11.9413 2.68376 11.8575C3.31876 8.15251 4.55251 5.88251 4.56501 5.86001C4.60501 5.78626 4.69501 5.76126 4.76626 5.80376C4.83626 5.84626 4.86001 5.94126 4.82001 6.01501C4.80751 6.03626 3.59876 8.26501 2.97376 11.9125C2.96126 11.9863 2.89876 12.0388 2.82876 12.0388V12.0388Z,M8.88126 12.0388C8.87251 12.0388 8.86376 12.0375 8.85501 12.0363C8.77501 12.0213 8.72126 11.9413 8.73626 11.8575C9.37126 8.15251 10.605 5.88251 10.6175 5.86001C10.6588 5.78626 10.7488 5.76126 10.8188 5.80376C10.8888 5.84626 10.9125 5.94126 10.8725 6.01501C10.86 6.03626 9.65126 8.26501 9.02626 11.9125C9.01251 11.9863 8.95001 12.0388 8.88126 12.0388V12.0388Z,M10.3975 12.0388C10.3888 12.0388 10.38 12.0375 10.3713 12.0363C10.2913 12.0213 10.2375 11.9413 10.2525 11.8575C10.8875 8.15251 12.1213 5.88251 12.1338 5.86001C12.175 5.78626 12.2638 5.76126 12.335 5.80376C12.405 5.84626 12.4288 5.94126 12.3888 6.01501C12.3763 6.03626 11.1675 8.26501 10.5425 11.9125C10.5288 11.9863 10.4663 12.0388 10.3975 12.0388V12.0388Z,M11.9138 12.0388C11.905 12.0388 11.8963 12.0375 11.8875 12.0363C11.8075 12.0213 11.7538 11.9413 11.7688 11.8575C12.205 9.31126 12.9213 7.45126 13.31 6.57001C13.345 6.49251 13.4313 6.45876 13.505 6.49501C13.5788 6.53126 13.6113 6.62251 13.5775 6.70001C13.195 7.56876 12.4888 9.40001 12.0588 11.9125C12.045 11.9863 11.9838 12.0388 11.9138 12.0388V12.0388Z,M10.3963 12.0388C10.3263 12.0388 10.2638 11.9863 10.2513 11.9113C9.62626 8.26376 8.41751 6.03501 8.40501 6.01376C8.36501 5.94001 8.38876 5.84501 8.45876 5.80251C8.52876 5.76001 8.61876 5.78501 8.66001 5.85876C8.67251 5.88126 9.90626 8.15126 10.5413 11.8563C10.5563 11.94 10.5025 12.02 10.4225 12.035C10.4138 12.0388 10.405 12.0388 10.3963 12.0388V12.0388Z,M11.9138 12.0388C11.8438 12.0388 11.7813 11.9863 11.7688 11.9113C11.1438 8.26376 9.93501 6.03501 9.92251 6.01376C9.88251 5.94001 9.90626 5.84501 9.97626 5.80251C10.0463 5.76001 10.1363 5.78501 10.1775 5.85876C10.19 5.88126 11.4238 8.15126 12.0588 11.8563C12.0738 11.94 12.02 12.02 11.94 12.035C11.9313 12.0388 11.9225 12.0388 11.9138 12.0388V12.0388Z,M13.3775 12.0388C13.3075 12.0388 13.245 11.9863 13.2325 11.9113C12.6075 8.26376 11.3988 6.03501 11.3863 6.01376C11.345 5.94001 11.37 5.84501 11.44 5.80251C11.51 5.76001 11.6 5.78501 11.6413 5.85876C11.6538 5.88126 12.8875 8.15126 13.5225 11.8563C13.5375 11.94 13.4838 12.02 13.4038 12.035C13.395 12.0388 13.3863 12.0388 13.3775 12.0388V12.0388Z,M4.30127 12.0388C4.23127 12.0388 4.17002 11.9863 4.15627 11.9113C3.53127 8.26376 2.32252 6.03501 2.31002 6.01376C2.27002 5.94001 2.29377 5.84501 2.36377 5.80251C2.43377 5.76001 2.52377 5.78501 2.56502 5.85876C2.57752 5.88126 3.81127 8.15126 4.44627 11.8563C4.46002 11.94 4.40752 12.02 4.32752 12.035C4.31877 12.0388 4.31002 12.0388 4.30127 12.0388V12.0388Z,M2.82875 12.2188C2.75875 12.2188 2.6975 12.1663 2.68375 12.0913C2.42875 10.605 2.0525 9.18376 1.56375 7.86751C1.535 7.78876 1.5725 7.69876 1.6475 7.66751C1.72375 7.63626 1.80875 7.67626 1.8375 7.75501C2.3325 9.09001 2.71375 10.53 2.9725 12.0363C2.9875 12.12 2.93375 12.2 2.85375 12.215C2.84625 12.2175 2.8375 12.2188 2.82875 12.2188V12.2188Z,M13.3788 12.2188C13.37 12.2188 13.3613 12.2175 13.3525 12.2163C13.2725 12.2013 13.22 12.1213 13.2338 12.0375C13.4925 10.5313 13.8738 9.09125 14.3688 7.75625C14.3988 7.67625 14.4838 7.6375 14.5588 7.66875C14.635 7.7 14.6725 7.78875 14.6425 7.86875C14.155 9.185 13.7775 10.6063 13.5238 12.0925C13.51 12.1663 13.4488 12.2188 13.3788 12.2188Z,M15.0175 13.0963C14.9913 13.0963 14.965 13.0938 14.9375 13.0875C8.44251 11.65 1.15126 13.075 1.07751 13.0888C0.878758 13.1288 0.685008 13 0.645008 12.8C0.605008 12.6 0.733758 12.4075 0.933758 12.3675C1.00751 12.3525 8.45251 10.8975 15.0963 12.3688C15.295 12.4125 15.42 12.6088 15.375 12.8075C15.3574 12.8893 15.3124 12.9625 15.2473 13.0151C15.1823 13.0676 15.1011 13.0963 15.0175 13.0963V13.0963Z,M15.22 13.915C14.6525 13.9188 14.6525 13.8238 14.4988 13.3175L13.185 6.47001V6.40001C13.185 6.14126 12.7613 5.83501 12.4038 5.83501H3.61876C3.26126 5.83501 2.83751 6.14126 2.83751 6.40001V6.47001L1.52501 13.3188C1.43501 13.9475 1.43501 13.9475 0.66376 13.9025C0.25876 13.8788 -0.18374 13.9163 0.0800102 13.0413L1.36876 6.32251C1.76626 4.36626 2.57751 4.36626 3.62001 4.36626H12.405C13.4475 4.36626 14.2163 4.36626 14.6563 6.32251L15.945 13.0413C16.1113 13.92 15.9075 13.9338 15.3613 13.92C15.3113 13.9188 15.2663 13.915 15.22 13.915V13.915Z',
    "volley4ballrack":'M4.5 11.5C4.5 14.3834 4.33286 16.9837 4.06569 18.8539C3.93156 19.7928 3.77511 20.5265 3.61016 21.0149C3.5715 21.1293 3.53443 21.224 3.5 21.3009C3.46557 21.224 3.4285 21.1293 3.38984 21.0149C3.22489 20.5265 3.06844 19.7928 2.93431 18.8539C2.66714 16.9837 2.5 14.3834 2.5 11.5C2.5 8.61655 2.66714 6.0163 2.93431 4.14609C3.06844 3.20721 3.22489 2.47352 3.38984 1.98514C3.4285 1.87067 3.46557 1.77601 3.5 1.69909C3.53443 1.77601 3.5715 1.87067 3.61016 1.98514C3.77511 2.47352 3.93156 3.20721 4.06569 4.14609C4.33286 6.0163 4.5 8.61655 4.5 11.5ZM3.35559 21.5454C3.35558 21.5451 3.35749 21.5431 3.36139 21.54C3.35756 21.5441 3.35561 21.5456 3.35559 21.5454ZM3.6386 21.54C3.64251 21.5431 3.64442 21.5451 3.64441 21.5454C3.64439 21.5456 3.64244 21.5441 3.6386 21.54ZM3.64441 1.4546C3.64442 1.45485 3.6425 1.4569 3.63857 1.46001C3.64243 1.4559 3.64439 1.45435 3.64441 1.4546ZM3.36143 1.46001C3.3575 1.4569 3.35558 1.45485 3.35559 1.4546C3.35561 1.45435 3.35757 1.4559 3.36143 1.46001Z,M20.5 11.5C20.5 14.3834 20.3329 16.9837 20.0657 18.8539C19.9316 19.7928 19.7751 20.5265 19.6102 21.0149C19.5715 21.1293 19.5344 21.224 19.5 21.3009C19.4656 21.224 19.4285 21.1293 19.3898 21.0149C19.2249 20.5265 19.0684 19.7928 18.9343 18.8539C18.6671 16.9837 18.5 14.3834 18.5 11.5C18.5 8.61655 18.6671 6.0163 18.9343 4.14609C19.0684 3.20721 19.2249 2.47352 19.3898 1.98514C19.4285 1.87067 19.4656 1.77601 19.5 1.69909C19.5344 1.77601 19.5715 1.87067 19.6102 1.98514C19.7751 2.47352 19.9316 3.20721 20.0657 4.14609C20.3329 6.0163 20.5 8.61655 20.5 11.5ZM19.3556 21.5454C19.3556 21.5451 19.3575 21.5431 19.3614 21.54C19.3576 21.5441 19.3556 21.5456 19.3556 21.5454ZM19.6386 21.54C19.6425 21.5431 19.6444 21.5451 19.6444 21.5454C19.6444 21.5456 19.6424 21.5441 19.6386 21.54ZM19.6444 1.4546C19.6444 1.45485 19.6425 1.4569 19.6386 1.46001C19.6424 1.4559 19.6444 1.45435 19.6444 1.4546ZM19.3614 1.46001C19.3575 1.4569 19.3556 1.45485 19.3556 1.4546C19.3556 1.45435 19.3576 1.4559 19.3614 1.46001Z,M8.03906 2.70312C8.15556 2.70312 8.25 2.60869 8.25 2.49219C8.25 2.37569 8.15556 2.28125 8.03906 2.28125C7.92256 2.28125 7.82812 2.37569 7.82812 2.49219C7.82812 2.60869 7.92256 2.70312 8.03906 2.70312Z,M8.39062 3.40625C8.22186 3.65234 8.3414 3.83515 8.39062 3.96875C8.42577 4.06015 8.44687 4.26406 8.4539 4.3625C8.49608 4.78437 8.52421 6.06406 8.52421 6.06406C8.53124 6.1414 8.47499 6.19062 8.41874 6.19062C8.36249 6.19062 8.3203 6.14843 8.31327 6.09922L8.12343 4.46093C8.1164 4.41875 8.08827 4.38359 8.03905 4.38359C7.98983 4.38359 7.96171 4.41875 7.95468 4.46093L7.76483 6.09922C7.7578 6.14843 7.71561 6.19062 7.65936 6.19062C7.60311 6.19062 7.54686 6.1414 7.5539 6.06406C7.5539 6.06406 7.58905 4.7914 7.63124 4.37656C7.63827 4.27109 7.65936 4.06718 7.68749 3.96172C7.72968 3.82812 7.85624 3.63125 7.68749 3.39922,M7.4625 3.33594C7.46953 3.13906 7.63125 2.98438 7.82812 2.98438H8.25C8.44687 2.98438 8.60859 3.13906 8.61563 3.33594C8.61563 3.33594 8.62266 3.80703 8.63672 3.98984C8.66484 4.33437 8.8125 4.73516 8.8125 4.73516C8.54531 4.73516 8.28516 3.44844 8.03906 3.44844C7.79297 3.44844 7.63828 4.73516 7.40625 4.73516L7.4625 3.33594Z,M8.0337 4.13996C8.02696 3.82042 7.95924 3.5051 7.83419 3.21096C7.03614 3.58361 6.44991 4.28674 6.24952 5.11643C6.36679 5.38512 6.53686 5.62752 6.74962 5.82922C6.95195 5.12567 7.40994 4.52316 8.0337 4.13996ZM7.70939 2.95871C7.57571 2.72581 7.40536 2.51599 7.20489 2.33733C6.40509 2.77502 5.93224 3.68117 6.10626 4.64182C6.39981 3.91145 6.9711 3.30588 7.70939 2.95871ZM9.35821 4.40979C9.4338 3.53264 9.11827 2.67395 8.50128 2.08596C8.37208 2.07102 8.04776 2.03762 7.63204 2.16066C8.14068 2.68773 8.4338 3.38597 8.45382 4.11817C8.73391 4.27219 9.0409 4.37118 9.35821 4.40979ZM8.26222 4.49328C7.98885 4.65926 7.74962 4.87582 7.55733 5.13137C8.27804 5.63498 9.17892 5.79143 9.9963 5.55149C10.1721 5.31592 10.2983 5.04711 10.3672 4.76135C10.1348 4.82057 9.89601 4.85127 9.65616 4.85276C9.17628 4.85188 8.69903 4.72883 8.26222 4.49328ZM7.39825 5.36955C7.26466 5.59807 7.17237 5.84768 7.11612 6.10959C7.506 6.34889 7.96149 6.45895 8.41762 6.42407C8.87374 6.38919 9.3072 6.21115 9.65616 5.91535C8.66388 6.05686 7.86935 5.69738 7.39825 5.36955ZM8.98292 2.20022C9.46896 2.81897 9.70802 3.61701 9.63858 4.42912C9.90634 4.42969 10.1725 4.38756 10.427 4.30432C10.427 4.28674 10.4296 4.26916 10.4296 4.25158C10.4296 3.30412 9.82579 2.50168 8.98292 2.20022Z,M14.0391 14.7031C14.1556 14.7031 14.25 14.6087 14.25 14.4922C14.25 14.3757 14.1556 14.2812 14.0391 14.2812C13.9226 14.2812 13.8281 14.3757 13.8281 14.4922C13.8281 14.6087 13.9226 14.7031 14.0391 14.7031Z,M14.3906 15.4062C14.2219 15.6523 14.3414 15.8352 14.3906 15.9687C14.4258 16.0602 14.4469 16.2641 14.4539 16.3625C14.4961 16.7844 14.5242 18.0641 14.5242 18.0641C14.5312 18.1414 14.475 18.1906 14.4187 18.1906C14.3625 18.1906 14.3203 18.1484 14.3133 18.0992L14.1234 16.4609C14.1164 16.4187 14.0883 16.3836 14.0391 16.3836C13.9898 16.3836 13.9617 16.4187 13.9547 16.4609L13.7648 18.0992C13.7578 18.1484 13.7156 18.1906 13.6594 18.1906C13.6031 18.1906 13.5469 18.1414 13.5539 18.0641C13.5539 18.0641 13.5891 16.7914 13.6312 16.3766C13.6383 16.2711 13.6594 16.0672 13.6875 15.9617C13.7297 15.8281 13.8562 15.6312 13.6875 15.3992,M13.4625 15.3359C13.4695 15.1391 13.6313 14.9844 13.8281 14.9844H14.25C14.4469 14.9844 14.6086 15.1391 14.6156 15.3359C14.6156 15.3359 14.6227 15.807 14.6367 15.9898C14.6648 16.3344 14.8125 16.7352 14.8125 16.7352C14.5453 16.7352 14.2852 15.4484 14.0391 15.4484C13.793 15.4484 13.6383 16.7352 13.4062 16.7352L13.4625 15.3359Z,M14.0337 16.14C14.027 15.8204 13.9592 15.5051 13.8342 15.211C13.0361 15.5836 12.4499 16.2867 12.2495 17.1164C12.3668 17.3851 12.5369 17.6275 12.7496 17.8292C12.9519 17.1257 13.4099 16.5232 14.0337 16.14ZM13.7094 14.9587C13.5757 14.7258 13.4054 14.516 13.2049 14.3373C12.4051 14.775 11.9322 15.6812 12.1063 16.6418C12.3998 15.9114 12.9711 15.3059 13.7094 14.9587ZM15.3582 16.4098C15.4338 15.5326 15.1183 14.6739 14.5013 14.086C14.3721 14.071 14.0478 14.0376 13.632 14.1607C14.1407 14.6877 14.4338 15.386 14.4538 16.1182C14.7339 16.2722 15.0409 16.3712 15.3582 16.4098ZM14.2622 16.4933C13.9888 16.6593 13.7496 16.8758 13.5573 17.1314C14.278 17.635 15.1789 17.7914 15.9963 17.5515C16.1721 17.3159 16.2983 17.0471 16.3672 16.7613C16.1348 16.8206 15.896 16.8513 15.6562 16.8528C15.1763 16.8519 14.699 16.7288 14.2622 16.4933ZM13.3983 17.3696C13.2647 17.5981 13.1724 17.8477 13.1161 18.1096C13.506 18.3489 13.9615 18.4589 14.4176 18.4241C14.8737 18.3892 15.3072 18.2111 15.6562 17.9154C14.6639 18.0569 13.8693 17.6974 13.3983 17.3696ZM14.9829 14.2002C15.469 14.819 15.708 15.617 15.6386 16.4291C15.9063 16.4297 16.1725 16.3876 16.427 16.3043C16.427 16.2867 16.4296 16.2692 16.4296 16.2516C16.4296 15.3041 15.8258 14.5017 14.9829 14.2002Z,M14.0391 8.70312C14.1556 8.70312 14.25 8.60869 14.25 8.49219C14.25 8.37569 14.1556 8.28125 14.0391 8.28125C13.9226 8.28125 13.8281 8.37569 13.8281 8.49219C13.8281 8.60869 13.9226 8.70312 14.0391 8.70312Z,M14.3906 9.40625C14.2219 9.65234 14.3414 9.83515 14.3906 9.96875C14.4258 10.0602 14.4469 10.2641 14.4539 10.3625C14.4961 10.7844 14.5242 12.0641 14.5242 12.0641C14.5312 12.1414 14.475 12.1906 14.4187 12.1906C14.3625 12.1906 14.3203 12.1484 14.3133 12.0992L14.1234 10.4609C14.1164 10.4187 14.0883 10.3836 14.0391 10.3836C13.9898 10.3836 13.9617 10.4187 13.9547 10.4609L13.7648 12.0992C13.7578 12.1484 13.7156 12.1906 13.6594 12.1906C13.6031 12.1906 13.5469 12.1414 13.5539 12.0641C13.5539 12.0641 13.5891 10.7914 13.6312 10.3766C13.6383 10.2711 13.6594 10.0672 13.6875 9.96172C13.7297 9.82812 13.8562 9.63125 13.6875 9.39922,M13.4625 9.33594C13.4695 9.13906 13.6313 8.98438 13.8281 8.98438H14.25C14.4469 8.98438 14.6086 9.13906 14.6156 9.33594C14.6156 9.33594 14.6227 9.80703 14.6367 9.98984C14.6648 10.3344 14.8125 10.7352 14.8125 10.7352C14.5453 10.7352 14.2852 9.44844 14.0391 9.44844C13.793 9.44844 13.6383 10.7352 13.4062 10.7352L13.4625 9.33594Z,M14.0337 10.14C14.027 9.82042 13.9592 9.5051 13.8342 9.21096C13.0361 9.58361 12.4499 10.2867 12.2495 11.1164C12.3668 11.3851 12.5369 11.6275 12.7496 11.8292C12.9519 11.1257 13.4099 10.5232 14.0337 10.14ZM13.7094 8.95871C13.5757 8.72581 13.4054 8.51599 13.2049 8.33733C12.4051 8.77502 11.9322 9.68117 12.1063 10.6418C12.3998 9.91145 12.9711 9.30588 13.7094 8.95871ZM15.3582 10.4098C15.4338 9.53264 15.1183 8.67395 14.5013 8.08596C14.3721 8.07102 14.0478 8.03762 13.632 8.16066C14.1407 8.68773 14.4338 9.38597 14.4538 10.1182C14.7339 10.2722 15.0409 10.3712 15.3582 10.4098ZM14.2622 10.4933C13.9888 10.6593 13.7496 10.8758 13.5573 11.1314C14.278 11.635 15.1789 11.7914 15.9963 11.5515C16.1721 11.3159 16.2983 11.0471 16.3672 10.7613C16.1348 10.8206 15.896 10.8513 15.6562 10.8528C15.1763 10.8519 14.699 10.7288 14.2622 10.4933ZM13.3983 11.3696C13.2647 11.5981 13.1724 11.8477 13.1161 12.1096C13.506 12.3489 13.9615 12.4589 14.4176 12.4241C14.8737 12.3892 15.3072 12.2111 15.6562 11.9154C14.6639 12.0569 13.8693 11.6974 13.3983 11.3696ZM14.9829 8.20022C15.469 8.81897 15.708 9.61701 15.6386 10.4291C15.9063 10.4297 16.1725 10.3876 16.427 10.3043C16.427 10.2867 16.4296 10.2692 16.4296 10.2516C16.4296 9.30412 15.8258 8.50168 14.9829 8.20022Z,M8.03906 8.70312C8.15556 8.70312 8.25 8.60869 8.25 8.49219C8.25 8.37569 8.15556 8.28125 8.03906 8.28125C7.92256 8.28125 7.82812 8.37569 7.82812 8.49219C7.82812 8.60869 7.92256 8.70312 8.03906 8.70312Z,M8.39062 9.40625C8.22186 9.65234 8.3414 9.83515 8.39062 9.96875C8.42577 10.0602 8.44687 10.2641 8.4539 10.3625C8.49608 10.7844 8.52421 12.0641 8.52421 12.0641C8.53124 12.1414 8.47499 12.1906 8.41874 12.1906C8.36249 12.1906 8.3203 12.1484 8.31327 12.0992L8.12343 10.4609C8.1164 10.4187 8.08827 10.3836 8.03905 10.3836C7.98983 10.3836 7.96171 10.4187 7.95468 10.4609L7.76483 12.0992C7.7578 12.1484 7.71561 12.1906 7.65936 12.1906C7.60311 12.1906 7.54686 12.1414 7.5539 12.0641C7.5539 12.0641 7.58905 10.7914 7.63124 10.3766C7.63827 10.2711 7.65936 10.0672 7.68749 9.96172C7.72968 9.82812 7.85624 9.63125 7.68749 9.39922,M7.4625 9.33594C7.46953 9.13906 7.63125 8.98438 7.82812 8.98438H8.25C8.44687 8.98438 8.60859 9.13906 8.61563 9.33594C8.61563 9.33594 8.62266 9.80703 8.63672 9.98984C8.66484 10.3344 8.8125 10.7352 8.8125 10.7352C8.54531 10.7352 8.28516 9.44844 8.03906 9.44844C7.79297 9.44844 7.63828 10.7352 7.40625 10.7352L7.4625 9.33594Z,M8.0337 10.14C8.02696 9.82042 7.95924 9.5051 7.83419 9.21096C7.03614 9.58361 6.44991 10.2867 6.24952 11.1164C6.36679 11.3851 6.53686 11.6275 6.74962 11.8292C6.95195 11.1257 7.40994 10.5232 8.0337 10.14ZM7.70939 8.95871C7.57571 8.72581 7.40536 8.51599 7.20489 8.33733C6.40509 8.77502 5.93224 9.68117 6.10626 10.6418C6.39981 9.91145 6.9711 9.30588 7.70939 8.95871ZM9.35821 10.4098C9.4338 9.53264 9.11827 8.67395 8.50128 8.08596C8.37208 8.07102 8.04776 8.03762 7.63204 8.16066C8.14068 8.68773 8.4338 9.38597 8.45382 10.1182C8.73391 10.2722 9.0409 10.3712 9.35821 10.4098ZM8.26222 10.4933C7.98885 10.6593 7.74962 10.8758 7.55733 11.1314C8.27804 11.635 9.17892 11.7914 9.9963 11.5515C10.1721 11.3159 10.2983 11.0471 10.3672 10.7613C10.1348 10.8206 9.89601 10.8513 9.65616 10.8528C9.17628 10.8519 8.69903 10.7288 8.26222 10.4933ZM7.39825 11.3696C7.26466 11.5981 7.17237 11.8477 7.11612 12.1096C7.506 12.3489 7.96149 12.4589 8.41762 12.4241C8.87374 12.3892 9.3072 12.2111 9.65616 11.9154C8.66388 12.0569 7.86935 11.6974 7.39825 11.3696ZM8.98292 8.20022C9.46896 8.81897 9.70802 9.61701 9.63858 10.4291C9.90634 10.4297 10.1725 10.3876 10.427 10.3043C10.427 10.2867 10.4296 10.2692 10.4296 10.2516C10.4296 9.30412 9.82579 8.50168 8.98292 8.20022Z,M8.03906 14.7031C8.15556 14.7031 8.25 14.6087 8.25 14.4922C8.25 14.3757 8.15556 14.2812 8.03906 14.2812C7.92256 14.2812 7.82812 14.3757 7.82812 14.4922C7.82812 14.6087 7.92256 14.7031 8.03906 14.7031Z,M8.39062 15.4062C8.22186 15.6523 8.3414 15.8352 8.39062 15.9687C8.42577 16.0602 8.44687 16.2641 8.4539 16.3625C8.49608 16.7844 8.52421 18.0641 8.52421 18.0641C8.53124 18.1414 8.47499 18.1906 8.41874 18.1906C8.36249 18.1906 8.3203 18.1484 8.31327 18.0992L8.12343 16.4609C8.1164 16.4187 8.08827 16.3836 8.03905 16.3836C7.98983 16.3836 7.96171 16.4187 7.95468 16.4609L7.76483 18.0992C7.7578 18.1484 7.71561 18.1906 7.65936 18.1906C7.60311 18.1906 7.54686 18.1414 7.5539 18.0641C7.5539 18.0641 7.58905 16.7914 7.63124 16.3766C7.63827 16.2711 7.65936 16.0672 7.68749 15.9617C7.72968 15.8281 7.85624 15.6312 7.68749 15.3992,M7.4625 15.3359C7.46953 15.1391 7.63125 14.9844 7.82812 14.9844H8.25C8.44687 14.9844 8.60859 15.1391 8.61563 15.3359C8.61563 15.3359 8.62266 15.807 8.63672 15.9898C8.66484 16.3344 8.8125 16.7352 8.8125 16.7352C8.54531 16.7352 8.28516 15.4484 8.03906 15.4484C7.79297 15.4484 7.63828 16.7352 7.40625 16.7352L7.4625 15.3359Z,M8.0337 16.14C8.02696 15.8204 7.95924 15.5051 7.83419 15.211C7.03614 15.5836 6.44991 16.2867 6.24952 17.1164C6.36679 17.3851 6.53686 17.6275 6.74962 17.8292C6.95195 17.1257 7.40994 16.5232 8.0337 16.14ZM7.70939 14.9587C7.57571 14.7258 7.40536 14.516 7.20489 14.3373C6.40509 14.775 5.93224 15.6812 6.10626 16.6418C6.39981 15.9114 6.9711 15.3059 7.70939 14.9587ZM9.35821 16.4098C9.4338 15.5326 9.11827 14.6739 8.50128 14.086C8.37208 14.071 8.04776 14.0376 7.63204 14.1607C8.14068 14.6877 8.4338 15.386 8.45382 16.1182C8.73391 16.2722 9.0409 16.3712 9.35821 16.4098ZM8.26222 16.4933C7.98885 16.6593 7.74962 16.8758 7.55733 17.1314C8.27804 17.635 9.17892 17.7914 9.9963 17.5515C10.1721 17.3159 10.2983 17.0471 10.3672 16.7613C10.1348 16.8206 9.89601 16.8513 9.65616 16.8528C9.17628 16.8519 8.69903 16.7288 8.26222 16.4933ZM7.39825 17.3696C7.26466 17.5981 7.17237 17.8477 7.11612 18.1096C7.506 18.3489 7.96149 18.4589 8.41762 18.4241C8.87374 18.3892 9.3072 18.2111 9.65616 17.9154C8.66388 18.0569 7.86935 17.6974 7.39825 17.3696ZM8.98292 14.2002C9.46896 14.819 9.70802 15.617 9.63858 16.4291C9.90634 16.4297 10.1725 16.3876 10.427 16.3043C10.427 16.2867 10.4296 16.2692 10.4296 16.2516C10.4296 15.3041 9.82579 14.5017 8.98292 14.2002Z',
    "soccernet":'M8.96204 4.66312V13.5703,M5.51672 4.66312L6.5011 6.60234V13.5703,M12.4073 4.66312L11.423 6.60234V13.5703,M4.56187 13.3988H13.3636,M2.88844 5.90625V13.9936,M4.07391 8.90297L0.999847 8.60063,M4.52672 11.1178L0.999847 11.5045,M4.12312 8.92266H13.8755,M3.98953 11.16H13.7841,M3.58594 6.68391H14.3381,M1.0786 14.8528L4.49157 13.4888,M15.1172 5.90625V13.9936,M13.9317 8.90297L17.0058 8.60063,M13.4789 11.1178L17.0058 11.5045,M16.9256 14.8528L13.5141 13.4888,M5.19048 10.1503C5.10891 8.99438 4.86141 7.86656 4.47469 6.88922C4.14844 6.06234 3.72516 5.35078 3.2836 4.88672C3.05547 4.64904 2.78873 4.45171 2.49469 4.30313C2.36813 4.23984 2.23313 4.21453 2.09251 4.22719C1.79298 4.25391 1.5286 4.46625 1.44141 4.75453C1.32329 5.14266 1.52719 5.52797 1.8886 5.67984C2.00954 5.73047 2.13469 5.82609 2.25141 5.92313C4.14563 7.48547 4.0486 12.3005 3.97407 13.7391C3.96563 13.8994 4.0936 14.0344 4.25532 14.0344H4.95704C5.1061 14.0344 5.22985 13.9177 5.23829 13.7672C5.23688 13.7503 5.32126 12.0108 5.19048 10.1503V10.1503Z,M12.8095 10.1503C12.8911 8.99438 13.1386 7.86656 13.5253 6.88922C13.8516 6.06234 14.2748 5.35078 14.7164 4.88672C14.9386 4.65328 15.2184 4.44656 15.5053 4.30313C15.6319 4.23984 15.7669 4.21453 15.9075 4.22719C16.207 4.25391 16.4714 4.46625 16.5586 4.75453C16.6767 5.14266 16.4728 5.52797 16.1114 5.67984C15.9905 5.73047 15.8653 5.82609 15.7486 5.92313C13.8572 7.48547 13.9528 12.2991 14.0273 13.7377C14.0358 13.898 13.9078 14.033 13.7461 14.033H13.0444C12.8953 14.033 12.7716 13.9163 12.7631 13.7658C12.7617 13.7503 12.6773 12.0108 12.8095 10.1503V10.1503Z,M2.15859 4.64625C2.21062 4.64625 2.25843 4.6575 2.30624 4.68141C2.55093 4.80234 2.78859 4.97953 2.97703 5.17781C3.38203 5.60391 3.77437 6.26766 4.08093 7.04531C4.45218 7.98328 4.68984 9.0675 4.76859 10.1812C4.87828 11.7211 4.83749 13.1752 4.82062 13.6125H4.40156C4.43812 12.7884 4.46062 11.3203 4.26796 9.82266C4.00218 7.75687 3.41296 6.33516 2.51859 5.59687C2.37656 5.48016 2.22328 5.36203 2.05031 5.29031C1.87734 5.21719 1.79156 5.04844 1.84359 4.87687C1.88156 4.75312 1.99828 4.65891 2.12765 4.64766C2.1389 4.64625 2.14874 4.64625 2.15859 4.64625V4.64625ZM2.15859 4.22437C2.13609 4.22437 2.11359 4.22578 2.09109 4.22719C1.79156 4.25391 1.52718 4.46625 1.43999 4.75453C1.32187 5.14266 1.52578 5.52797 1.88718 5.67984C2.00812 5.73047 2.13328 5.82609 2.24999 5.92312C4.14421 7.48547 4.04718 12.3005 3.97265 13.7391C3.96421 13.8994 4.09218 14.0344 4.2539 14.0344H4.95562C5.10468 14.0344 5.22843 13.9177 5.23687 13.7672C5.23828 13.7503 5.32265 12.0094 5.19046 10.1503C5.1089 8.99437 4.8614 7.86656 4.47468 6.88922C4.14843 6.06234 3.72515 5.35078 3.28359 4.88672C3.05546 4.64903 2.78872 4.45171 2.49468 4.30312C2.39016 4.25147 2.27517 4.22453 2.15859 4.22437V4.22437Z,M15.8414 4.64625C15.8512 4.64625 15.8611 4.64625 15.8723 4.64766C16.0017 4.65891 16.1198 4.75312 16.1564 4.87687C16.2084 5.04844 16.1241 5.21719 15.9497 5.29031C15.7781 5.36203 15.6234 5.48016 15.4814 5.59687C14.587 6.33516 13.9978 7.75687 13.732 9.82266C13.5394 11.3203 13.5619 12.7884 13.5984 13.6125H13.1794C13.1625 13.1737 13.1217 11.7211 13.2314 10.1812C13.3102 9.0675 13.5478 7.98328 13.9191 7.04531C14.227 6.26766 14.6194 5.60391 15.023 5.17781C15.2114 4.97953 15.4491 4.80375 15.6937 4.68141C15.7416 4.6575 15.7894 4.64625 15.8414 4.64625V4.64625ZM15.8414 4.22437C15.7247 4.22437 15.6122 4.25109 15.5067 4.30312C15.2122 4.451 14.9454 4.6484 14.7178 4.88672C14.2762 5.35078 13.8544 6.06234 13.5267 6.88922C13.14 7.86656 12.8925 8.99437 12.8109 10.1503C12.6787 12.0094 12.7631 13.7489 12.7645 13.7672C12.773 13.9162 12.8953 14.0344 13.0458 14.0344H13.7475C13.9092 14.0344 14.0372 13.8994 14.0287 13.7391C13.9528 12.2991 13.8572 7.48547 15.75 5.92312C15.8667 5.8275 15.9905 5.73187 16.1128 5.67984C16.4742 5.52797 16.6781 5.14266 16.56 4.75453C16.4728 4.46625 16.2084 4.25391 15.9089 4.22719C15.8864 4.22578 15.8639 4.22437 15.8414 4.22437V4.22437Z,M1.82532 15.3675H0.981567C0.74813 15.3675 0.559692 15.1791 0.559692 14.9456L0.566724 5.0625C0.566724 4.33125 1.16016 3.73922 1.89 3.73922H16.1156C16.8469 3.73922 17.4389 4.33125 17.4389 5.0625V14.9442C17.4389 15.1777 17.2505 15.3661 17.017 15.3661H16.1733C15.9398 15.3661 15.7514 15.1777 15.7514 14.9442V6.18891C15.7514 5.76844 15.4111 5.42813 14.9906 5.42813H2.73516C2.60804 5.42831 2.48618 5.47889 2.39629 5.56878C2.3064 5.65867 2.25582 5.78053 2.25563 5.90766L2.2486 14.947C2.24789 15.0588 2.20298 15.1658 2.12367 15.2446C2.04436 15.3233 1.9371 15.3675 1.82532 15.3675V15.3675Z,M16.1156 4.16109C16.6134 4.16109 17.017 4.56609 17.017 5.0625V14.9442H16.1733V6.18891C16.1733 5.53641 15.6431 5.00625 14.9906 5.00625H2.73516C2.49469 5.00625 2.26828 5.10047 2.09813 5.27063C1.92797 5.44078 1.83375 5.66719 1.83375 5.90766L1.82672 14.947H0.982971L0.988596 5.0625C0.988596 4.56609 1.3936 4.16109 1.89 4.16109H16.1156ZM16.1156 3.73922H1.89141C1.16016 3.73922 0.568127 4.33125 0.568127 5.0625L0.561096 14.9456C0.561096 15.1791 0.749534 15.3675 0.982971 15.3675H1.82672C2.06016 15.3675 2.2486 15.1791 2.2486 14.9456L2.25563 5.90625C2.25581 5.77913 2.30639 5.65727 2.39628 5.56738C2.48617 5.47749 2.60804 5.42691 2.73516 5.42672H14.992C15.4125 5.42672 15.7528 5.76703 15.7528 6.1875V14.9442C15.7528 15.1777 15.9413 15.3661 16.1747 15.3661H17.0184C17.2519 15.3661 17.4403 15.1777 17.4403 14.9442V5.06391C17.4403 4.33266 16.8469 3.73922 16.1156 3.73922V3.73922Z',
    "soccerball":'M17.98 8.99745C17.9863 8.78355 18.0427 5.7263 16.2334 3.73614C16.153 3.55824 15.7717 2.84125 14.5411 1.96497C13.9956 1.5418 13.4161 1.16423 12.8086 0.836086L12.8062 0.834886C12.7294 0.793787 11.2288 0 9.40755 0C9.26926 0 9.13246 0.00809989 8.99716 0.0173997V0.0149997C7.60847 -0.0152998 6.22908 0.341994 5.39779 0.717288C4.66039 1.05028 3.8417 1.60857 3.7826 1.65177C2.76141 2.22296 0.82492 4.51523 0.671621 5.7299C0.0527257 6.52099 -0.46447 10.0744 0.672821 12.2389C1.47021 15.2469 4.47199 16.7523 4.71079 16.8678C4.85599 16.9605 6.49188 17.9718 8.50156 17.9718C8.58586 17.9718 9.09556 18 9.27736 18C11.4496 18 14.6686 16.4688 15.3424 15.2694C17.1937 13.9153 18.1534 10.4254 17.98 8.99745ZM4.72729 13.5163C3.8666 12.124 3.3761 10.3048 3.2711 9.88694C3.5435 9.47864 4.88719 7.49747 5.65278 6.90138C6.08628 6.98118 7.89647 7.31358 9.60375 7.62257C9.81825 8.17846 10.7593 10.6312 11.0287 11.578C10.7317 11.9302 9.56505 13.2886 8.41636 14.3524C7.19687 14.3581 5.12269 13.6546 4.72729 13.5163ZM15.547 3.77394C15.5434 3.90893 15.5113 4.38893 15.2815 4.94002C14.8252 4.70692 13.6783 4.20773 12.1063 4.12343C11.8684 3.77214 10.9732 2.54726 9.55935 1.69767C9.75285 1.31908 10.0222 0.857386 10.1797 0.716688C10.2307 0.702288 10.3099 0.689089 10.4305 0.689089C11.1886 0.689089 12.4984 1.18558 12.6124 1.22968C12.7333 1.29358 15.0877 2.56136 15.547 3.77394ZM2.9318 9.60344C1.90491 9.42824 1.29442 9.10905 1.11202 9.00105C0.73012 7.61597 1.03762 6.119 1.08502 5.9045C1.46182 5.23071 2.53461 3.51324 3.2423 3.18715C3.9758 3.03745 4.89049 3.22345 5.26309 3.31434C5.22799 3.79884 5.16049 5.15241 5.36089 6.57289C4.54909 7.22628 3.2642 9.10695 2.9318 9.60344V9.60344ZM8.90536 0.458992C9.13576 0.476092 9.47385 0.526491 9.70545 0.59519C9.47445 0.902385 9.23776 1.35778 9.12586 1.58277C8.65486 1.65987 6.86597 2.00187 5.46258 2.91175C5.17969 2.83675 4.32529 2.63666 3.5162 2.70565C3.7166 2.31776 4.016 2.03097 4.0481 2.00157C4.15939 1.92177 6.30198 0.422693 8.90536 0.455092V0.458992V0.458992ZM14.6341 11.8867C14.2831 11.8723 12.9307 11.7952 11.4478 11.4469C11.1637 10.4563 10.2256 8.01377 10.0111 7.45818C10.6936 6.48542 11.3865 5.51999 12.0895 4.56202C13.7959 4.65562 14.9941 5.27811 15.226 5.40801C16.2145 6.99768 16.4314 8.62126 16.4611 8.89245C15.9361 10.5262 14.8978 11.6263 14.6341 11.8867V11.8867ZM0.496422 7.95557C0.521622 8.33536 0.582522 8.73525 0.692621 9.13065C0.593638 9.38686 0.524972 9.65377 0.488022 9.92594C0.425369 9.2705 0.428183 8.61045 0.496422 7.95557V7.95557ZM3.3896 14.9632C3.842 14.5273 4.39969 14.1031 4.61599 13.9429C5.10499 14.1151 7.11317 14.794 8.39326 14.794C8.61136 15.0864 9.32445 16.0023 10.1986 16.7025C9.65445 17.235 8.86846 17.4864 8.72956 17.5281C6.29148 17.5935 3.917 16.2231 3.3896 14.9632V14.9632ZM9.82845 17.5245C10.105 17.3634 10.3933 17.1513 10.6318 16.8828C11.0209 16.8291 12.6907 16.5417 14.1997 15.4332C14.2993 15.444 14.4634 15.4572 14.6467 15.4521C13.7413 16.3392 11.5321 17.3301 9.82845 17.5245ZM14.4556 15.0118C14.9977 13.5994 14.9746 12.5344 14.9479 12.1942C15.2455 11.9026 16.2667 10.8145 16.8334 9.16035C17.1388 9.21135 17.3374 9.28905 17.4316 9.33254C17.4643 9.45254 17.5189 9.72974 17.488 10.15C17.257 11.6629 16.4596 13.93 15.0628 14.9323C14.9224 15.004 14.6752 15.0196 14.4556 15.0118',
    "mininet":'M5.82587 7.6725C5.75587 7.6725 5.69462 7.62 5.68087 7.545C5.05587 3.8975 3.84712 1.66875 3.83462 1.6475C3.79462 1.57375 3.81837 1.47875 3.88837 1.43625C3.95837 1.39375 4.04837 1.41875 4.08962 1.4925C4.10212 1.515 5.33587 3.785 5.97087 7.49C5.98462 7.57375 5.93212 7.65375 5.85212 7.66875C5.84337 7.6725 5.83462 7.6725 5.82587 7.6725V7.6725Z,M7.41962 7.6725C7.34962 7.6725 7.28837 7.62 7.27462 7.545C6.64962 3.8975 5.44087 1.66875 5.42837 1.6475C5.38837 1.57375 5.41212 1.47875 5.48212 1.43625C5.55212 1.39375 5.64212 1.41875 5.68337 1.4925C5.69587 1.515 6.92962 3.785 7.56462 7.49C7.57837 7.57375 7.52587 7.65375 7.44587 7.66875C7.43712 7.6725 7.42837 7.6725 7.41962 7.6725V7.6725Z,M8.88086 7.6725C8.81086 7.6725 8.74836 7.62 8.73586 7.545C8.11086 3.8975 6.90211 1.66875 6.88961 1.6475C6.84961 1.57375 6.87336 1.47875 6.94336 1.43625C7.01336 1.39375 7.10336 1.41875 7.14461 1.4925C7.15711 1.515 8.39086 3.785 9.02461 7.49C9.03961 7.57375 8.98586 7.65375 8.90586 7.66875C8.89836 7.6725 8.88836 7.6725 8.88086 7.6725V7.6725Z,M2.82836 7.6725C2.81961 7.6725 2.81086 7.67125 2.80211 7.67C2.72211 7.655 2.66836 7.575 2.68336 7.49125C3.31836 3.78625 4.55211 1.51625 4.56461 1.49375C4.60461 1.42 4.69461 1.395 4.76586 1.4375C4.83586 1.48 4.85961 1.575 4.81961 1.64875C4.80711 1.67 3.59836 3.89875 2.97336 7.54625C2.96086 7.62 2.89836 7.6725 2.82836 7.6725V7.6725Z,M4.30212 7.6725C4.29337 7.6725 4.28462 7.67125 4.27587 7.67C4.19587 7.655 4.14337 7.575 4.15712 7.49125C4.79212 3.78625 6.02587 1.51625 6.03837 1.49375C6.04749 1.47644 6.06004 1.46117 6.07525 1.44888C6.09047 1.43659 6.10804 1.42753 6.12688 1.42227C6.14572 1.417 6.16544 1.41564 6.18482 1.41826C6.20421 1.42088 6.22286 1.42742 6.23962 1.4375C6.30962 1.48 6.33462 1.575 6.29337 1.64875C6.28087 1.67 5.07212 3.89875 4.44712 7.54625C4.43337 7.62 4.37087 7.6725 4.30212 7.6725Z,M5.88211 7.6725C5.87336 7.6725 5.86461 7.67125 5.85586 7.67C5.77586 7.655 5.72336 7.575 5.73711 7.49125C6.37211 3.78625 7.60586 1.51625 7.61836 1.49375C7.62747 1.47644 7.64002 1.46117 7.65524 1.44888C7.67046 1.43659 7.68803 1.42753 7.70687 1.42227C7.72571 1.417 7.74542 1.41564 7.76481 1.41826C7.7842 1.42088 7.80284 1.42742 7.81961 1.4375C7.88961 1.48 7.91461 1.575 7.87336 1.64875C7.86086 1.67 6.65211 3.89875 6.02711 7.54625C6.01461 7.62 5.95211 7.6725 5.88211 7.6725Z,M7.42086 7.6725C7.41211 7.6725 7.40336 7.67125 7.39461 7.67C7.31461 7.655 7.26086 7.575 7.27586 7.49125C7.91086 3.7875 9.08461 1.51875 9.09711 1.49625C9.13586 1.42125 9.22586 1.39375 9.29711 1.435C9.36836 1.47625 9.39461 1.57 9.35586 1.645C9.34461 1.6675 8.19211 3.89625 7.56711 7.54625C7.55211 7.62 7.48961 7.6725 7.42086 7.6725V7.6725Z,M8.88085 7.6725C8.8721 7.6725 8.86335 7.67125 8.8546 7.67C8.7746 7.655 8.72085 7.575 8.73585 7.49125C9.37085 3.78625 10.6046 1.51625 10.6171 1.49375C10.6584 1.42 10.7484 1.395 10.8184 1.4375C10.8884 1.48 10.9121 1.575 10.8721 1.64875C10.8596 1.67 9.65085 3.89875 9.02585 7.54625C9.0121 7.62 8.9496 7.6725 8.88085 7.6725V7.6725Z,M10.3971 7.6725C10.3884 7.6725 10.3796 7.67125 10.3709 7.67C10.2909 7.655 10.2371 7.575 10.2521 7.49125C10.8871 3.78625 12.1209 1.51625 12.1334 1.49375C12.1746 1.42 12.2634 1.395 12.3346 1.4375C12.4046 1.48 12.4284 1.575 12.3884 1.64875C12.3759 1.67 11.1671 3.89875 10.5421 7.54625C10.5284 7.62 10.4659 7.6725 10.3971 7.6725V7.6725Z,M11.9134 7.6725C11.9046 7.6725 11.8959 7.67125 11.8871 7.67C11.8071 7.655 11.7534 7.575 11.7684 7.49125C12.2046 4.945 12.9209 3.085 13.3096 2.20375C13.3446 2.12625 13.4309 2.0925 13.5046 2.12875C13.5784 2.165 13.6109 2.25625 13.5771 2.33375C13.1946 3.2025 12.4884 5.03375 12.0584 7.54625C12.0446 7.62 11.9834 7.6725 11.9134 7.6725V7.6725Z,M10.3959 7.6725C10.3259 7.6725 10.2634 7.62 10.2509 7.545C9.62588 3.8975 8.41713 1.66875 8.40463 1.6475C8.36463 1.57375 8.38838 1.47875 8.45838 1.43625C8.52838 1.39375 8.61838 1.41875 8.65963 1.4925C8.67213 1.515 9.90588 3.785 10.5409 7.49C10.5559 7.57375 10.5021 7.65375 10.4221 7.66875C10.4134 7.6725 10.4046 7.6725 10.3959 7.6725V7.6725Z,M11.9134 7.6725C11.8434 7.6725 11.7809 7.62 11.7684 7.545C11.1434 3.8975 9.93461 1.66875 9.92211 1.6475C9.88211 1.57375 9.90586 1.47875 9.97586 1.43625C10.0459 1.39375 10.1359 1.41875 10.1771 1.4925C10.1896 1.515 11.4234 3.785 12.0584 7.49C12.0734 7.57375 12.0196 7.65375 11.9396 7.66875C11.9309 7.6725 11.9221 7.6725 11.9134 7.6725V7.6725Z,M13.3771 7.6725C13.3071 7.6725 13.2446 7.62 13.2321 7.545C12.6071 3.8975 11.3984 1.66875 11.3859 1.6475C11.3446 1.57375 11.3696 1.47875 11.4396 1.43625C11.5096 1.39375 11.5996 1.41875 11.6409 1.4925C11.6534 1.515 12.8871 3.785 13.5221 7.49C13.5371 7.57375 13.4834 7.65375 13.4034 7.66875C13.3946 7.6725 13.3859 7.6725 13.3771 7.6725V7.6725Z,M4.30087 7.6725C4.23087 7.6725 4.16962 7.62 4.15587 7.545C3.53087 3.8975 2.32212 1.66875 2.30962 1.6475C2.26962 1.57375 2.29337 1.47875 2.36337 1.43625C2.43337 1.39375 2.52337 1.41875 2.56462 1.4925C2.57712 1.515 3.81087 3.785 4.44587 7.49C4.45962 7.57375 4.40712 7.65375 4.32712 7.66875C4.31837 7.6725 4.30962 7.6725 4.30087 7.6725V7.6725Z,M2.82835 7.8525C2.75835 7.8525 2.6971 7.8 2.68335 7.725C2.42835 6.23875 2.0521 4.8175 1.56335 3.50125C1.5346 3.4225 1.5721 3.3325 1.6471 3.30125C1.72335 3.27 1.80835 3.31 1.8371 3.38875C2.3321 4.72375 2.71335 6.16375 2.9721 7.67C2.9871 7.75375 2.93335 7.83375 2.85335 7.84875C2.84585 7.85125 2.8371 7.8525 2.82835 7.8525V7.8525Z,M13.3784 7.8525C13.3696 7.8525 13.3609 7.85125 13.3521 7.85C13.2721 7.835 13.2196 7.755 13.2334 7.67125C13.4921 6.165 13.8734 4.725 14.3684 3.39C14.3984 3.31 14.4834 3.27125 14.5584 3.3025C14.6346 3.33375 14.6721 3.4225 14.6421 3.5025C14.1546 4.81875 13.7771 6.24 13.5234 7.72625C13.5096 7.8 13.4484 7.8525 13.3784 7.8525Z,M12.1221 7.9525C11.9196 7.94375 11.7621 7.765 11.7709 7.5525C11.9421 3.33 13.4046 0.994999 13.4671 0.897499C13.5809 0.719999 13.8096 0.672499 13.9771 0.789999C14.1459 0.907499 14.1909 1.1475 14.0771 1.325C14.0634 1.3475 12.6671 3.59375 12.5046 7.5825C12.4971 7.795 12.3246 7.96125 12.1221 7.9525Z,M4.55507 7.99968C4.81132 7.99121 5.01063 7.81811 4.99956 7.61232C4.78285 3.52331 2.93212 1.26091 2.85303 1.1665C2.70909 0.994608 2.41962 0.94861 2.20607 1.0624C1.99252 1.17618 1.93558 1.40859 2.07952 1.58048C2.09692 1.60227 3.86381 3.77751 4.06945 7.64017C4.08052 7.84716 4.29723 8.00815 4.55507 7.99968Z,M15.0171 8.73C14.9909 8.73 14.9646 8.7275 14.9371 8.72125C8.44211 7.28375 1.15086 8.70875 1.07711 8.7225C0.878361 8.7625 0.684611 8.63375 0.644611 8.43375C0.604611 8.23375 0.733361 8.04125 0.933361 8.00125C1.00711 7.98625 8.45211 6.53125 15.0959 8.0025C15.2946 8.04625 15.4196 8.2425 15.3746 8.44125C15.3571 8.52302 15.312 8.59629 15.2469 8.64884C15.1819 8.70138 15.1007 8.73003 15.0171 8.73V8.73Z,M15.2196 9.54875C14.6521 9.5525 14.6521 9.4575 14.4984 8.95125L13.1846 2.10375V2.03375C13.1846 1.775 12.7609 1.46875 12.4034 1.46875H3.61836C3.26086 1.46875 2.83711 1.775 2.83711 2.03375V2.10375L1.52461 8.9525C1.43461 9.58125 1.43461 9.58125 0.663364 9.53625C0.258364 9.5125 -0.184136 9.55 0.0796135 8.675L1.36836 1.95625C1.76586 2.38419e-07 2.57711 0 3.61961 0H12.4046C13.4471 0 14.2159 2.38419e-07 14.6559 1.95625L15.9446 8.675C16.1109 9.55375 15.9071 9.5675 15.3609 9.55375C15.3109 9.5525 15.2659 9.54875 15.2196 9.54875V9.54875Z',
    "archs":'M19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10',
    "fivesoccerball":'M8 10C7.60444 10 7.21776 9.8827 6.88886 9.66294C6.55996 9.44318 6.30362 9.13082 6.15224 8.76537C6.00087 8.39992 5.96126 7.99778 6.03843 7.60982C6.1156 7.22186 6.30608 6.86549 6.58579 6.58579C6.86549 6.30608 7.22186 6.1156 7.60982 6.03843C7.99778 5.96126 8.39992 6.00087 8.76537 6.15224C9.13082 6.30362 9.44318 6.55996 9.66294 6.88886C9.8827 7.21776 10 7.60444 10 8C9.99934 8.53023 9.78841 9.03855 9.41348 9.41348C9.03855 9.78841 8.53023 9.99934 8 10ZM8 7C7.80222 7 7.60888 7.05865 7.44443 7.16853C7.27998 7.27841 7.15181 7.43459 7.07612 7.61732C7.00043 7.80004 6.98063 8.00111 7.01922 8.19509C7.0578 8.38907 7.15304 8.56726 7.29289 8.70711C7.43275 8.84696 7.61093 8.9422 7.80491 8.98079C7.99889 9.01937 8.19996 8.99957 8.38268 8.92388C8.56541 8.84819 8.72159 8.72002 8.83147 8.55557C8.94135 8.39112 9 8.19778 9 8C8.99974 7.73487 8.89429 7.48067 8.70682 7.29319C8.51934 7.10571 8.26514 7.00027 8 7Z,M2.5 10C2.10444 10 1.71776 9.8827 1.38886 9.66294C1.05996 9.44318 0.803617 9.13082 0.652242 8.76537C0.500867 8.39992 0.46126 7.99778 0.53843 7.60982C0.615601 7.22186 0.806082 6.86549 1.08579 6.58579C1.36549 6.30608 1.72186 6.1156 2.10982 6.03843C2.49778 5.96126 2.89992 6.00087 3.26537 6.15224C3.63082 6.30362 3.94318 6.55996 4.16294 6.88886C4.3827 7.21776 4.5 7.60444 4.5 8C4.49934 8.53023 4.28841 9.03855 3.91348 9.41348C3.53855 9.78841 3.03023 9.99934 2.5 10ZM2.5 7C2.30222 7 2.10888 7.05865 1.94443 7.16853C1.77998 7.27841 1.65181 7.43459 1.57612 7.61732C1.50043 7.80004 1.48063 8.00111 1.51922 8.19509C1.5578 8.38907 1.65304 8.56726 1.79289 8.70711C1.93275 8.84696 2.11093 8.9422 2.30491 8.98079C2.49889 9.01937 2.69996 8.99957 2.88268 8.92388C3.06541 8.84819 3.22159 8.72002 3.33147 8.55557C3.44135 8.39112 3.5 8.19778 3.5 8C3.49974 7.73487 3.39429 7.48067 3.20682 7.29319C3.01934 7.10571 2.76514 7.00027 2.5 7Z,M5 15.5C4.60444 15.5 4.21776 15.3827 3.88886 15.1629C3.55996 14.9432 3.30362 14.6308 3.15224 14.2654C3.00087 13.8999 2.96126 13.4978 3.03843 13.1098C3.1156 12.7219 3.30608 12.3655 3.58579 12.0858C3.86549 11.8061 4.22186 11.6156 4.60982 11.5384C4.99778 11.4613 5.39992 11.5009 5.76537 11.6522C6.13082 11.8036 6.44318 12.06 6.66294 12.3889C6.8827 12.7178 7 13.1044 7 13.5C6.99934 14.0302 6.78841 14.5386 6.41348 14.9135C6.03855 15.2884 5.53023 15.4993 5 15.5ZM5 12.5C4.80222 12.5 4.60888 12.5587 4.44443 12.6685C4.27998 12.7784 4.15181 12.9346 4.07612 13.1173C4.00043 13.3 3.98063 13.5011 4.01922 13.6951C4.0578 13.8891 4.15304 14.0673 4.29289 14.2071C4.43275 14.347 4.61093 14.4422 4.80491 14.4808C4.99889 14.5194 5.19996 14.4996 5.38268 14.4239C5.56541 14.3482 5.72159 14.22 5.83147 14.0556C5.94135 13.8911 6 13.6978 6 13.5C5.99974 13.2349 5.89429 12.9807 5.70682 12.7932C5.51934 12.6057 5.26514 12.5003 5 12.5Z,M11 4.5C10.6044 4.5 10.2178 4.3827 9.88886 4.16294C9.55996 3.94318 9.30362 3.63082 9.15224 3.26537C9.00087 2.89992 8.96126 2.49778 9.03843 2.10982C9.1156 1.72186 9.30608 1.36549 9.58579 1.08579C9.86549 0.806082 10.2219 0.615601 10.6098 0.53843C10.9978 0.46126 11.3999 0.500867 11.7654 0.652242C12.1308 0.803617 12.4432 1.05996 12.6629 1.38886C12.8827 1.71776 13 2.10444 13 2.5C12.9993 3.03023 12.7884 3.53855 12.4135 3.91348C12.0386 4.28841 11.5302 4.49934 11 4.5ZM11 1.5C10.8022 1.5 10.6089 1.55865 10.4444 1.66853C10.28 1.77841 10.1518 1.93459 10.0761 2.11732C10.0004 2.30004 9.98063 2.50111 10.0192 2.69509C10.0578 2.88907 10.153 3.06726 10.2929 3.20711C10.4327 3.34696 10.6109 3.4422 10.8049 3.48079C10.9989 3.51937 11.2 3.49957 11.3827 3.42388C11.5654 3.34819 11.7216 3.22002 11.8315 3.05557C11.9414 2.89112 12 2.69778 12 2.5C11.9997 2.23487 11.8943 1.98067 11.7068 1.79319C11.5193 1.60571 11.2651 1.50027 11 1.5Z,M5 4.5C4.60444 4.5 4.21776 4.3827 3.88886 4.16294C3.55996 3.94318 3.30362 3.63082 3.15224 3.26537C3.00087 2.89992 2.96126 2.49778 3.03843 2.10982C3.1156 1.72186 3.30608 1.36549 3.58579 1.08579C3.86549 0.806082 4.22186 0.615601 4.60982 0.53843C4.99778 0.46126 5.39992 0.500867 5.76537 0.652242C6.13082 0.803617 6.44318 1.05996 6.66294 1.38886C6.8827 1.71776 7 2.10444 7 2.5C6.99934 3.03023 6.78841 3.53855 6.41348 3.91348C6.03855 4.28841 5.53023 4.49934 5 4.5ZM5 1.5C4.80222 1.5 4.60888 1.55865 4.44443 1.66853C4.27998 1.77841 4.15181 1.93459 4.07612 2.11732C4.00043 2.30004 3.98063 2.50111 4.01922 2.69509C4.0578 2.88907 4.15304 3.06726 4.29289 3.20711C4.43275 3.34696 4.61093 3.4422 4.80491 3.48079C4.99889 3.51937 5.19996 3.49957 5.38268 3.42388C5.56541 3.34819 5.72159 3.22002 5.83147 3.05557C5.94135 2.89112 6 2.69778 6 2.5C5.99974 2.23487 5.89429 1.98067 5.70682 1.79319C5.51934 1.60571 5.26514 1.50027 5 1.5Z',
    "hocstick":'M7.64531 13.8375C5.84062 13.6875 3.675 13.2 1.575 12.6375C0.951562 12.4875 0.229686 16.1625 0.918749 16.425C5.11875 17.925 9.54844 17.55 11.1891 17.25C11.7797 17.1375 12.2062 16.35 12.2391 16.35L14.8641 11.325L13.3547 10.2375C10.9922 13.425 8.82656 13.95 7.64531 13.8375,M18.5391 0.75C18.5391 0.75 13.9125 9.4875 13.3219 10.2375L14.8312 11.325L20.3437 0.75H18.5391Z,M2.98594 12.975L2.46094 17.0625C5.25 17.775 7.94063 17.7 9.74531 17.5125L10.3359 13.0125C9.25313 13.6875 8.30156 13.8375 7.67812 13.8C6.26719 13.6875 4.62656 13.3875 2.98594 12.975,M3.01875 17.175L3.51094 17.2875L4.42969 13.3125L3.9375 13.2L3.01875 17.175Z,M7.94063 17.625H8.46563L9.64688 13.3875L9.05625 13.6125L7.94063 17.625Z,M5.28282 17.5125C5.44688 17.5125 5.61095 17.55 5.77501 17.55L6.03751 13.575C5.87345 13.5375 5.70938 13.5375 5.54532 13.5L5.28282 17.5125Z,M7.25157 13.7625L6.52969 17.625H7.02188L7.77657 13.8H7.67813C7.54688 13.7625 7.41563 13.7625 7.25157 13.7625',
    "puck":'M7 9.72645C9.76142 9.72645 12 8.92021 12 7.92568C12 6.93114 9.76142 6.12491 7 6.12491C4.23858 6.12491 2 6.93114 2 7.92568C2 8.92021 4.23858 9.72645 7 9.72645Z,M7 7.60154C9.76142 7.60154 12 6.79531 12 5.80077C12 4.80623 9.76142 4 7 4C4.23858 4 2 4.80623 2 5.80077C2 6.79531 4.23858 7.60154 7 7.60154Z,M2.0376 5.80077H12V7.92568H2.0376V5.80077Z',
    "pucks":'M6.5 16.7264C9.53756 16.7264 12 15.7794 12 14.6112C12 13.443 9.53756 12.496 6.5 12.496C3.46243 12.496 1 13.443 1 14.6112C1 15.7794 3.46243 16.7264 6.5 16.7264Z,M6.5 14.2305C9.53756 14.2305 12 13.2834 12 12.1152C12 10.947 9.53756 10 6.5 10C3.46243 10 1 10.947 1 12.1152C1 13.2834 3.46243 14.2305 6.5 14.2305Z,M1.04135 12.1152H12V14.6112H1.04135V12.1152Z,M19.5 16.7264C22.5376 16.7264 25 15.7794 25 14.6112C25 13.443 22.5376 12.496 19.5 12.496C16.4624 12.496 14 13.443 14 14.6112C14 15.7794 16.4624 16.7264 19.5 16.7264Z,M19.5 14.2305C22.5376 14.2305 25 13.2834 25 12.1152C25 10.947 22.5376 10 19.5 10C16.4624 10 14 10.947 14 12.1152C14 13.2834 16.4624 14.2305 19.5 14.2305Z,M14.0414 12.1152H25V14.6112H14.0414V12.1152Z,M19.5 25.7264C22.5376 25.7264 25 24.7794 25 23.6112C25 22.443 22.5376 21.496 19.5 21.496C16.4624 21.496 14 22.443 14 23.6112C14 24.7794 16.4624 25.7264 19.5 25.7264Z,M19.5 23.2305C22.5376 23.2305 25 22.2834 25 21.1152C25 19.947 22.5376 19 19.5 19C16.4624 19 14 19.947 14 21.1152C14 22.2834 16.4624 23.2305 19.5 23.2305Z,M14.0414 21.1152H25V23.6112H14.0414V21.1152Z,M19.5 7.72645C22.5376 7.72645 25 6.77942 25 5.61121C25 4.443 22.5376 3.49598 19.5 3.49598C16.4624 3.49598 14 4.443 14 5.61121C14 6.77942 16.4624 7.72645 19.5 7.72645Z,M19.5 5.23047C22.5376 5.23047 25 4.28345 25 3.11523C25 1.94702 22.5376 1 19.5 1C16.4624 1 14 1.94702 14 3.11523C14 4.28345 16.4624 5.23047 19.5 5.23047Z,M14.0414 3.11523H25V5.61121H14.0414V3.11523Z,M6.5 7.72645C9.53756 7.72645 12 6.77942 12 5.61121C12 4.443 9.53756 3.49598 6.5 3.49598C3.46243 3.49598 1 4.443 1 5.61121C1 6.77942 3.46243 7.72645 6.5 7.72645Z,M6.5 5.23047C9.53756 5.23047 12 4.28345 12 3.11523C12 1.94702 9.53756 1 6.5 1C3.46243 1 1 1.94702 1 3.11523C1 4.28345 3.46243 5.23047 6.5 5.23047Z,M1.04135 3.11523H12V5.61121H1.04135V3.11523Z,M6.5 25.7264C9.53756 25.7264 12 24.7794 12 23.6112C12 22.443 9.53756 21.496 6.5 21.496C3.46243 21.496 1 22.443 1 23.6112C1 24.7794 3.46243 25.7264 6.5 25.7264Z,M6.5 23.2305C9.53756 23.2305 12 22.2834 12 21.1152C12 19.947 9.53756 19 6.5 19C3.46243 19 1 19.947 1 21.1152C1 22.2834 3.46243 23.2305 6.5 23.2305Z,M1.04135 21.1152H12V23.6112H1.04135V21.1152Z',
    "hocnet":'M7.88159 13.6743C7.76603 13.6743 7.66492 13.6033 7.64222 13.5018C6.61043 8.56711 4.61495 5.55184 4.59432 5.52309C4.52828 5.42331 4.56749 5.29479 4.68305 5.23729C4.79861 5.17979 4.94719 5.21361 5.01529 5.31339C5.03592 5.34383 7.07267 8.41491 8.12097 13.4274C8.14366 13.5407 8.05699 13.6489 7.92493 13.6692C7.91048 13.6743 7.89604 13.6743 7.88159 13.6743Z,M9.06901 13.6743C8.95345 13.6743 8.85234 13.6033 8.82964 13.5018C7.79785 8.56711 5.80238 5.55184 5.78174 5.52309C5.71571 5.42331 5.75491 5.29479 5.87047 5.23729C5.98603 5.17979 6.13461 5.21361 6.20271 5.31339C6.22335 5.34383 8.26009 8.41491 9.30839 13.4274C9.33109 13.5407 9.24442 13.6489 9.11235 13.6692C9.0979 13.6743 9.08346 13.6743 9.06901 13.6743V13.6743Z,M10.2579 13.6743C10.1423 13.6743 10.039 13.6033 10.0184 13.5018C8.98617 8.56711 6.98984 5.55184 6.96919 5.52309C6.90313 5.42331 6.94236 5.29479 7.05796 5.23729C7.17357 5.17979 7.32222 5.21361 7.39034 5.31339C7.41099 5.34383 9.44861 8.41491 10.4953 13.4274C10.5201 13.5407 10.4313 13.6489 10.2992 13.6692C10.2868 13.6743 10.2703 13.6743 10.2579 13.6743V13.6743Z,M5.9932 13.6743C5.97875 13.6743 5.96431 13.6726 5.94987 13.6709C5.81782 13.6506 5.7291 13.5424 5.75386 13.429C6.80199 8.41555 8.83843 5.34386 8.85907 5.31341C8.92509 5.21362 9.07365 5.17979 9.19125 5.2373C9.30679 5.29481 9.346 5.42336 9.27997 5.52315C9.25934 5.55191 7.26417 8.56778 6.23253 13.5035C6.2119 13.6033 6.10874 13.6743 5.9932 13.6743V13.6743Z,M3.61778 13.6743C3.60334 13.6743 3.5889 13.6726 3.57446 13.6709C3.44242 13.6506 3.35578 13.5424 3.37847 13.429C4.4265 8.41542 6.46272 5.34365 6.48335 5.3132C6.49839 5.28978 6.5191 5.26912 6.54422 5.25248C6.56934 5.23585 6.59833 5.2236 6.62942 5.21647C6.66052 5.20934 6.69306 5.2075 6.72506 5.21104C6.75705 5.21459 6.78783 5.22345 6.8155 5.23708C6.93103 5.29459 6.97229 5.42315 6.90421 5.52295C6.88358 5.5517 4.88862 8.56766 3.8571 13.5035C3.8344 13.6033 3.73125 13.6743 3.61778 13.6743Z,M8.36749 13.6743C8.35305 13.6743 8.33861 13.6726 8.32417 13.6709C8.19213 13.6506 8.10549 13.5424 8.12818 13.429C9.17621 8.41542 11.2124 5.34365 11.2331 5.3132C11.2481 5.28978 11.2688 5.26912 11.2939 5.25248C11.319 5.23585 11.348 5.2236 11.3791 5.21647C11.4102 5.20934 11.4428 5.2075 11.4748 5.21104C11.5068 5.21459 11.5375 5.22345 11.5652 5.23708C11.6807 5.29459 11.722 5.42315 11.6539 5.52295C11.6333 5.5517 9.63833 8.56766 8.60681 13.5035C8.58618 13.6033 8.48302 13.6743 8.36749 13.6743Z,M9.56218 13.6743C9.54734 13.6743 9.5325 13.6726 9.51766 13.6709C9.38198 13.6506 9.29082 13.5424 9.31626 13.4291C10.3932 8.41807 12.3839 5.34855 12.4051 5.31811C12.4708 5.21664 12.6235 5.17943 12.7443 5.23524C12.8651 5.29105 12.9097 5.41789 12.8439 5.51936C12.8249 5.5498 10.8702 8.5652 9.81022 13.5035C9.78478 13.6033 9.67878 13.6743 9.56218 13.6743V13.6743Z,M11.9303 13.6743C11.9159 13.6743 11.9015 13.6726 11.887 13.6709C11.755 13.6506 11.6662 13.5424 11.691 13.429C12.7391 8.41555 14.7756 5.34386 14.7962 5.31341C14.8643 5.21362 15.0129 5.17979 15.1284 5.2373C15.2439 5.29481 15.2831 5.42336 15.2171 5.52315C15.1965 5.55191 13.2013 8.56778 12.1697 13.5035C12.147 13.6033 12.0438 13.6743 11.9303 13.6743V13.6743Z,M13.1178 13.6743C13.1033 13.6743 13.0889 13.6726 13.0745 13.6709C12.9424 13.6506 12.8537 13.5424 12.8784 13.429C13.9266 8.41555 15.963 5.34386 15.9837 5.31341C16.0517 5.21362 16.1982 5.17979 16.3158 5.2373C16.4314 5.29481 16.4706 5.42336 16.4046 5.52315C16.3839 5.55191 14.3888 8.56778 13.3571 13.5035C13.3344 13.6033 13.2313 13.6743 13.1178 13.6743V13.6743Z,M15.4411 13.6743C15.4298 13.6743 15.4184 13.6727 15.407 13.671C15.3029 13.6515 15.2329 13.547 15.2524 13.4377C15.8202 10.1139 16.7525 7.68587 17.2585 6.5355C17.304 6.43434 17.4163 6.39028 17.5123 6.4376C17.6083 6.48492 17.6506 6.60404 17.6066 6.7052C17.1088 7.83925 16.1895 10.2297 15.6299 13.5095C15.612 13.6058 15.5323 13.6743 15.4411 13.6743V13.6743Z,M11.4434 13.6743C11.3278 13.6743 11.2247 13.6033 11.204 13.5018C10.1724 8.56711 8.17723 5.55184 8.1566 5.52309C8.09057 5.42331 8.12978 5.29479 8.24532 5.23729C8.36086 5.17979 8.50942 5.21361 8.5775 5.31339C8.59814 5.34383 10.6346 8.41491 11.6827 13.4274C11.7075 13.5407 11.6188 13.6489 11.4867 13.6692C11.4723 13.6743 11.4578 13.6743 11.4434 13.6743V13.6743Z,M12.6308 13.6743C12.5153 13.6743 12.4121 13.6033 12.3915 13.5018C11.3598 8.56711 9.36465 5.55184 9.34402 5.52309C9.278 5.42331 9.3172 5.29479 9.43274 5.23729C9.54828 5.17979 9.69684 5.21361 9.76493 5.31339C9.78556 5.34383 11.822 8.41491 12.8701 13.4274C12.8949 13.5407 12.8062 13.6489 12.6741 13.6692C12.6597 13.6743 12.6452 13.6743 12.6308 13.6743V13.6743Z,M13.8182 13.6743C13.7027 13.6743 13.5995 13.6033 13.5789 13.5018C12.5473 8.56711 10.5521 5.55184 10.5315 5.52309C10.4654 5.42331 10.5046 5.29479 10.6202 5.23729C10.7357 5.17979 10.8843 5.21361 10.9524 5.31339C10.973 5.34383 13.0094 8.41491 14.0576 13.4274C14.0823 13.5407 13.9936 13.6489 13.8616 13.6692C13.8471 13.6743 13.8327 13.6743 13.8182 13.6743V13.6743Z,M15.0057 13.6743C14.8901 13.6743 14.787 13.6033 14.7663 13.5018C13.7347 8.56711 11.7395 5.55184 11.7189 5.52309C11.6529 5.42331 11.6921 5.29479 11.8076 5.23729C11.9231 5.17979 12.0717 5.21361 12.1398 5.31339C12.1604 5.34383 14.1969 8.41491 15.245 13.4274C15.2698 13.5407 15.181 13.6489 15.049 13.6692C15.0345 13.6743 15.0201 13.6743 15.0057 13.6743V13.6743Z,M16.1931 13.6743C16.0776 13.6743 15.9744 13.6033 15.9538 13.5018C14.9221 8.56711 12.927 5.55184 12.9063 5.52309C12.8403 5.42331 12.8795 5.29479 12.995 5.23729C13.1106 5.17979 13.2591 5.21361 13.3272 5.31339C13.3479 5.34383 15.3843 8.41491 16.4324 13.4274C16.4572 13.5407 16.3685 13.6489 16.2364 13.6692C16.222 13.6743 16.2075 13.6743 16.1931 13.6743V13.6743Z,M17.3805 13.6743C17.265 13.6743 17.1618 13.6033 17.1412 13.5018C16.1096 8.56711 14.1144 5.55184 14.0937 5.52309C14.0277 5.42331 14.0669 5.29479 14.1825 5.23729C14.298 5.17979 14.4466 5.21361 14.5147 5.31339C14.5353 5.34383 16.5717 8.41491 17.6199 13.4274C17.6446 13.5407 17.5559 13.6489 17.4239 13.6692C17.4094 13.6743 17.395 13.6743 17.3805 13.6743V13.6743Z,M17.3806 13.6743C17.2651 13.6743 17.1619 13.6033 17.1413 13.5018C16.1099 8.56711 14.1153 5.55184 14.0947 5.52309C14.0266 5.42331 14.0678 5.29479 14.1834 5.23729C14.2989 5.17979 14.4474 5.21361 14.5155 5.31339C14.5361 5.34383 16.572 8.41491 17.6199 13.4274C17.6446 13.5407 17.5559 13.6489 17.4239 13.6692C17.4095 13.6743 17.395 13.6743 17.3806 13.6743V13.6743Z,M6.69417 13.6743C6.57861 13.6743 6.47749 13.6033 6.45479 13.5018C5.42301 8.56711 3.42753 5.55184 3.40689 5.52309C3.34086 5.42331 3.38007 5.29479 3.49563 5.23729C3.61119 5.17979 3.75976 5.21361 3.82786 5.31339C3.8485 5.34383 5.88525 8.41491 6.93354 13.4274C6.95624 13.5407 6.86957 13.6489 6.7375 13.6692C6.72306 13.6743 6.70861 13.6743 6.69417 13.6743V13.6743Z,M5.47428 14.0867C5.35985 14.0703 5.26667 14.0057 5.25412 13.9307C4.71515 10.2938 3.03414 7.87763 3.01652 7.85436C2.96089 7.77441 3.01229 7.68907 3.13235 7.66482C3.2524 7.64057 3.39622 7.68559 3.45389 7.76584C3.47135 7.7903 5.18776 10.2518 5.73547 13.946C5.74686 14.0294 5.65045 14.0937 5.51769 14.0892C5.50289 14.0908 5.48858 14.0887 5.47428 14.0867V14.0867Z,M4.31783 13.6743C4.20083 13.6743 4.09847 13.6186 4.07548 13.5391C3.64929 11.9632 3.02046 10.4562 2.20359 9.06051C2.15554 8.97701 2.21822 8.88158 2.34357 8.84844C2.47101 8.81531 2.61307 8.85772 2.66112 8.94122C3.48843 10.3568 4.12563 11.8837 4.55808 13.4808C4.58315 13.5696 4.49332 13.6544 4.35961 13.6703C4.34708 13.673 4.33245 13.6743 4.31783 13.6743V13.6743Z,M16.6825 13.6743C16.6679 13.6743 16.6533 13.673 16.6387 13.6717C16.505 13.6557 16.4173 13.5709 16.4402 13.4821C16.8726 11.8846 17.5096 10.3573 18.3367 8.94141C18.3869 8.85657 18.5289 8.81547 18.6542 8.84861C18.7816 8.88176 18.8443 8.97588 18.7942 9.06073C17.9796 10.4567 17.3488 11.9641 16.9248 13.5404C16.9018 13.6186 16.7995 13.6743 16.6825 13.6743Z,M18.8318 14.5571C18.8006 14.5571 18.7694 14.5541 18.7368 14.5465C11.0244 12.8082 2.36656 14.5314 2.27899 14.548C2.04298 14.5964 1.81292 14.4407 1.76542 14.1988C1.71793 13.957 1.87081 13.7242 2.10829 13.6758C2.19587 13.6577 11.0363 11.8982 18.9253 13.6773C19.1613 13.7302 19.3097 13.9676 19.2563 14.2079C19.2354 14.3068 19.1819 14.3954 19.1046 14.4589C19.0274 14.5225 18.9311 14.5571 18.8318 14.5571V14.5571Z,M19.0722 15.5472C18.3983 15.5517 18.3983 15.4368 18.2158 14.8246L16.6558 6.54404V6.45939C16.6558 6.14649 16.1526 5.77614 15.7281 5.77614H5.29655C4.87204 5.77614 4.36887 6.14649 4.36887 6.45939V6.54404L2.81037 14.8261C2.7035 15.5865 2.7035 15.5865 1.7877 15.5321C1.30679 15.5034 0.186818 15.5581 0.500003 14.5L2 6.36567C2.472 4 3.7621 3.5 5 3.5H10.5H15.7281C16.966 3.5 18.7175 4 19.2399 6.36567L19.9331 10.5L20.5 14.5C20.6974 15.5627 19.8886 15.5699 19.2399 15.5532C19.1806 15.5517 19.1271 15.5472 19.0722 15.5472Z',
    "passthrough":'M16.0894 12.4587C17.6117 12.3145 19.4385 11.8462 21.21 11.3058C21.7359 11.1617 22.3448 14.6924 21.7635 14.9446C18.2206 16.3857 14.484 16.0254 13.1 15.7372C12.6018 15.6291 12.242 14.8725 12.2143 14.8725L10 10.0448L11.2732 9C13.2661 12.0623 15.0929 12.5667 16.0894 12.4587,M5.91064 12.4587C4.3883 12.3145 2.56149 11.8462 0.790042 11.3058C0.264143 11.1617 -0.344793 14.6924 0.236464 14.9446C3.77936 16.3857 7.51602 16.0254 8.89996 15.7372C9.39818 15.6291 9.75801 14.8725 9.78569 14.8725L12 10.0448L10.7268 9C8.73389 12.0623 6.90708 12.5667 5.91064 12.4587,M6.54206 1C6.54206 1 10.4953 8.43617 11 9.07447L9.71028 10L5 1H6.54206Z,M15.4579 1C15.4579 1 11.5047 8.43617 11 9.07447L12.2897 10L17 1H15.4579Z,M20.5333 12L21 15.5044C18.5208 16.1153 16.1292 16.051 14.525 15.8902L14 12.0322C14.9625 12.6109 15.8083 12.7395 16.3625 12.7073C17.6167 12.6109 19.075 12.3537 20.5333 12,M1.46667 12L1 15.5044C3.47917 16.1153 5.87083 16.051 7.475 15.8902L8 12.0322C7.0375 12.6109 6.19167 12.7395 5.6375 12.7073C4.38333 12.6109 2.925 12.3537 1.46667 12,M19.9465 15.4801L19.5218 15.5793L18.7292 12.075L19.1538 11.9758L19.9465 15.4801Z,M15.7003 15.8768H15.2474L14.2283 12.1411L14.7378 12.3395L15.7003 15.8768Z,M17.9932 15.7777C17.8517 15.7777 17.7102 15.8107 17.5686 15.8107L17.3422 12.3064C17.4837 12.2733 17.6252 12.2733 17.7668 12.2403L17.9932 15.7777Z,M16.2948 12.4717L16.9175 15.8768H16.4929L15.8418 12.5048H15.9268C16.04 12.4717 16.1532 12.4717 16.2948 12.4717,M2.05354 15.4801L2.47815 15.5793L3.27077 12.075L2.84615 11.9758L2.05354 15.4801Z,M6.2997 15.8768H6.75262L7.7717 12.1411L7.26216 12.3395L6.2997 15.8768Z,M4.00677 15.7777C4.14831 15.7777 4.28984 15.8107 4.43138 15.8107L4.65784 12.3064C4.51631 12.2733 4.37477 12.2733 4.23323 12.2403L4.00677 15.7777Z,M5.70524 12.4717L5.08247 15.8768H5.50708L6.15816 12.5048H6.07324C5.96001 12.4717 5.84677 12.4717 5.70524 12.4717',
    "tire":'M16 8C16 10.1217 15.1571 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16C5.87827 16 3.84344 15.1571 2.34315 13.6569C0.842855 12.1566 0 10.1217 0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8V8ZM8 11C8.79565 11 9.55871 10.6839 10.1213 10.1213C10.6839 9.55871 11 8.79565 11 8C11 7.20435 10.6839 6.44129 10.1213 5.87868C9.55871 5.31607 8.79565 5 8 5C7.20435 5 6.44129 5.31607 5.87868 5.87868C5.31607 6.44129 5 7.20435 5 8C5 8.79565 5.31607 9.55871 5.87868 10.1213C6.44129 10.6839 7.20435 11 8 11V11Z',
    "HorizontalBar": "M0 0L28 0V4H0L0 0Z",
    "verticalbar": "M0 28L0 -4.76837e-07H4L4 28H0Z",

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
    $('.'+selectedSport).css('display','table');
    $('.'+selectedSport+'surface').css('display','block'); 
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
        if(colochangetype == "svgicon") {
            mode  = colochangetype;
            colorchanger = 1;
            colorSelected = $(this).attr('id');
            drawShapes();
            mode = "";
            $("#Select").removeClass('selectedTool');
            attacktype = '';
            $(".color-picker").css('display','none');
            colorchanger = 0;
            // deleteShapeId = colorchangeId;
            //var shape = selecteShape;
           //shape.style.Stroke = "orange";
           //console.log(shape);
           //$('#'+shape).css('display','none');
           //console.log(e);
            // colorSelected = $(this).attr('id');
            // drawShapes(e);
        }
        else if (colochangetype == "sf") {
             mode  = "attack";
            colorchanger = 1;
            colorSelected = $(this).attr('id');
            drawShapes();
            mode = "";
            $("#Select").removeClass('selectedTool');
            attacktype = '';
            $(".color-picker").css('display','none');
            colorchanger = 0;
        }
        if(mode  == "Dtext") {
            DtextCount = 2;
            textarea.style.color = colorSelected;
            var scrollposition = 0;
                if(scroll> 80){
                    scrollposition = scroll+10/2;
                }
                textarea.style.textAlign = alignment;
                textarea.style.top = areaPosition.y + scrollposition + 5 + 'px';
                // if(textarea.value ==""){
                //    $("canvas:last").remove();
                // }
        }
        else {
            $(textarea).css('display','none');
        }
        $('.color-indicator').css('background-color',colorSelected);
        $('.color-indicator').css('border-color',colorSelected);
    }
    else {
        colorSelected = $(this).attr('id');
        if(mode  == "Dtext") {
            textarea.style.color = colorSelected;
            //$("canvas:last").remove();
        }
        else {
            $(textarea).css('display','none');
        }
        $('.color-indicator').css('background-color',colorSelected);
        $('.color-indicator').css('border-color',colorSelected);
        colorchanger = 0;
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
    DtextCount = 2;
    textarea.style.fontSize = Tsize+'px';
    if(mode == "Dtext") {
        //$("canvas:last").remove();
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
$(".sports-selection").click(function(e) {
    if(lastsegment == "drills" || lastsegment == "drills#") {
        myHistory = [];
        myHistory[1] = 1;
        historyIndex = 0;
        $('.konvajs-content').empty();
        selectedSport = $(e.target).text();
        $('#sports').val(selectedSport);
       $('.selectedsport').text(selectedSport);
       $('.toolbox').css('display','none');
       $('.surface').css('display','none');
       $('.color-picker').css('display','none');
        $('.attacklist').css('display','none');
        $('.lines-option').css('display','none');
        $('.fontcontainer').css('display','none');
       $('.'+selectedSport).css('display','table');
       $('.'+selectedSport+'surface').css('display','block'); 
       if( selectedSport == "Basketball" ) {
            $("#rink").val("basketball_court_one");
            selectedground = "basketball_court_one";
            setTimeout(function(){ 
                $("#rink").val(selectedground); 
            }, 1000);
        }
        else if(selectedSport == "Hockey"){
            selectedground = "hockeycourt_one";
            setTimeout(function(){ 
                $("#rink").val(selectedground); 
            }, 1000);
        }
        $(textarea).css('display','none');
        $('.text-alignment').css('display',"none");
        courtDisplay();
        $("#exampleFormControlTextarea1").val('');
    }
     else if(lastsegment != "drills" || lastsegment != "drills#") {
        $('#newDrill').modal('show'); 
    }
});
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
    var drill_name = $( "[name='name']").val();
    var drill_mins = $( "[name='mins']").val();
    var drill_surface = $( "[name='surface']").val();
    var drill_sports = $( "[name='sports']").val();
    var drill_sketchpad_data = $( "[name='sketchpad_data']").val();
    var drill_description = $( "[name='description']").val();
    var drill_notes = $( "[name='notes']").val();
    var drill_tags =  $("[name='tags[]']").val();
    var drill_age_group =  $("[name='age_group[]']").val();
    drill_age_group = drill_age_group.length;
    drill_tags = drill_tags.length;
    if( drill_name.trim() == ""      ) {
        alert("Please enter Drill Name");
    }
    else if( drill_mins.trim() == "" ||  drill_mins.trim() == "Mins" ) {
        alert("Please select Mins");
    }
    else if( drill_surface.trim() == "" ) {
        alert("Please select the Surface");
    }
    else if(drill_sports.trim() == "") {
        alert("Please select the sport");
    }
    else if(drill_sketchpad_data.trim() == "" ) {
        alert("Please create plan");
    }
    else if( drill_description.trim() == "" || drill_notes.trim() == "" ) {
        alert("Please add the description");
    }
    else if(drill_notes.trim() == "" ) {
        alert("Please add the notes");
    }
    else if(drill_tags == 0 ) {
        alert("Please add the tags");
    }
    else if(drill_age_group == 0 ) {
        alert("Please add the age group");
    }
    else {
        $('form#drawdetails').submit();
    }
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
    DtextCount = 2;
    alignment = $(this).attr("data-align");
    textarea.style.textAlign = alignment;
    if(scroll> 80){
        scrollposition = scroll+10/2;
    }
    textarea.style.textAlign = alignment;
    //textarea.style.top = areaPosition.y + scrollposition + 5 + 'px';
    // if(textarea.value !=""){
    //   $("canvas:last").remove();
    // }
    // if(textarea == "undefined") {
    // }
    // else {
    //    $(textarea).css('display','none');
    // }
})
$(document).on('click', '.newdrill', function() {
    if(lastsegment != "drills" || lastsegment != "drills#") {
        window.location.href = '../drills';
    }
    if(lastsegment == "drills" || lastsegment == "drills#")  {
        location.reload();
    } 
});
$('.surface').click(function(e){
    if(lastsegment == "drills" || lastsegment == "drills#") {
        $(textarea).css('display','none');
        myHistory = [];
        myHistory[1] = 1;
        historyIndex = 0;
        selectedground = $(this).attr("data-ground");
        $('.konvajs-content').empty();
        $("#rink").val(selectedground);
        // sessionStorage.setItem("selectedground", selectedground);
        $(".tool").removeClass('selectedTool');
        $('.color-picker').css('display','none');
        $('.attacklist').css('display','none');
        $('.lines-option').css('display','none');
        $('.text-alignment').css('display','none');
        $('.fontcontainer').css('display','none');
        courtDisplay();
        $("#exampleFormControlTextarea1").val('');
    }
    else if(lastsegment != "drills" || lastsegment != "drills#") {
        $('#newDrill').modal('show'); 
    }
});
setTimeout(function(){ 
    var z =   $("#sports").val();
    $('.selectedsport').text(z);
    $('.surface').css('display','none');
    $('.'+selectedSport).css('display','table');
    $('.'+selectedSport+'surface').css('display','block'); 
}, 200);
window.addEventListener("scroll", (event) => {
    scroll = this.scrollY;
    console.log(scroll)
});