/*!
 * Flash export buttons for Buttons and DataTables.
 * 2015 SpryMedia Ltd - datatables.net/license
 *
 * ZeroClipbaord - MIT license
 * Copyright (c) 2012 Joseph Huckaby
 */
(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net','datatables.net-buttons'],function($){return factory($,window,document);});}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window;}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$;}
if(!$.fn.dataTable.Buttons){require('datatables.net-buttons')(root,$);}
return factory($,root,root.document);};}
else{factory(jQuery,window,document);}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;var ZeroClipboard_TableTools={version:"1.0.4-TableTools2",clients:{},moviePath:'',nextId:1,$:function(thingy){if(typeof(thingy)=='string'){thingy=document.getElementById(thingy);}
if(!thingy.addClass){thingy.hide=function(){this.style.display='none';};thingy.show=function(){this.style.display='';};thingy.addClass=function(name){this.removeClass(name);this.className+=' '+name;};thingy.removeClass=function(name){this.className=this.className.replace(new RegExp("\\s*"+name+"\\s*")," ").replace(/^\s+/,'').replace(/\s+$/,'');};thingy.hasClass=function(name){return!!this.className.match(new RegExp("\\s*"+name+"\\s*"));};}
return thingy;},setMoviePath:function(path){this.moviePath=path;},dispatch:function(id,eventName,args){var client=this.clients[id];if(client){client.receiveEvent(eventName,args);}},log:function(str){console.log('Flash: '+str);},register:function(id,client){this.clients[id]=client;},getDOMObjectPosition:function(obj){var info={left:0,top:0,width:obj.width?obj.width:obj.offsetWidth,height:obj.height?obj.height:obj.offsetHeight};if(obj.style.width!==""){info.width=obj.style.width.replace("px","");}
if(obj.style.height!==""){info.height=obj.style.height.replace("px","");}
while(obj){info.left+=obj.offsetLeft;info.top+=obj.offsetTop;obj=obj.offsetParent;}
return info;},Client:function(elem){this.handlers={};this.id=ZeroClipboard_TableTools.nextId++;this.movieId='ZeroClipboard_TableToolsMovie_'+this.id;ZeroClipboard_TableTools.register(this.id,this);if(elem){this.glue(elem);}}};ZeroClipboard_TableTools.Client.prototype={id:0,ready:false,movie:null,clipText:'',fileName:'',action:'copy',handCursorEnabled:true,cssEffects:true,handlers:null,sized:false,sheetName:'',glue:function(elem,title){this.domElement=ZeroClipboard_TableTools.$(elem);var zIndex=99;if(this.domElement.style.zIndex){zIndex=parseInt(this.domElement.style.zIndex,10)+1;}
var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);this.div=document.createElement('div');var style=this.div.style;style.position='absolute';style.left='0px';style.top='0px';style.width=(box.width)+'px';style.height=box.height+'px';style.zIndex=zIndex;if(typeof title!="undefined"&&title!==""){this.div.title=title;}
if(box.width!==0&&box.height!==0){this.sized=true;}
if(this.domElement){this.domElement.appendChild(this.div);this.div.innerHTML=this.getHTML(box.width,box.height).replace(/&/g,'&amp;');}},positionElement:function(){var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);var style=this.div.style;style.position='absolute';style.width=box.width+'px';style.height=box.height+'px';if(box.width!==0&&box.height!==0){this.sized=true;}else{return;}
var flash=this.div.childNodes[0];flash.width=box.width;flash.height=box.height;},getHTML:function(width,height){var html='';var flashvars='id='+this.id+
'&width='+width+
'&height='+height;if(navigator.userAgent.match(/MSIE/)){var protocol=location.href.match(/^https/i)?'https://':'http://';html+='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+protocol+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+width+'" height="'+height+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+ZeroClipboard_TableTools.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+flashvars+'"/><param name="wmode" value="transparent"/></object>';}
else{html+='<embed id="'+this.movieId+'" src="'+ZeroClipboard_TableTools.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+width+'" height="'+height+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashvars+'" wmode="transparent" />';}
return html;},hide:function(){if(this.div){this.div.style.left='-2000px';}},show:function(){this.reposition();},destroy:function(){var that=this;if(this.domElement&&this.div){$(this.div).remove();this.domElement=null;this.div=null;$.each(ZeroClipboard_TableTools.clients,function(id,client){if(client===that){delete ZeroClipboard_TableTools.clients[id];}});}},reposition:function(elem){if(elem){this.domElement=ZeroClipboard_TableTools.$(elem);if(!this.domElement){this.hide();}}
if(this.domElement&&this.div){var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);var style=this.div.style;style.left=''+box.left+'px';style.top=''+box.top+'px';}},clearText:function(){this.clipText='';if(this.ready){this.movie.clearText();}},appendText:function(newText){this.clipText+=newText;if(this.ready){this.movie.appendText(newText);}},setText:function(newText){this.clipText=newText;if(this.ready){this.movie.setText(newText);}},setFileName:function(newText){this.fileName=newText;if(this.ready){this.movie.setFileName(newText);}},setSheetData:function(data){if(this.ready){this.movie.setSheetData(JSON.stringify(data));}},setAction:function(newText){this.action=newText;if(this.ready){this.movie.setAction(newText);}},addEventListener:function(eventName,func){eventName=eventName.toString().toLowerCase().replace(/^on/,'');if(!this.handlers[eventName]){this.handlers[eventName]=[];}
this.handlers[eventName].push(func);},setHandCursor:function(enabled){this.handCursorEnabled=enabled;if(this.ready){this.movie.setHandCursor(enabled);}},setCSSEffects:function(enabled){this.cssEffects=!!enabled;},receiveEvent:function(eventName,args){var self;eventName=eventName.toString().toLowerCase().replace(/^on/,'');switch(eventName){case'load':this.movie=document.getElementById(this.movieId);if(!this.movie){self=this;setTimeout(function(){self.receiveEvent('load',null);},1);return;}
if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){self=this;setTimeout(function(){self.receiveEvent('load',null);},100);this.ready=true;return;}
this.ready=true;this.movie.clearText();this.movie.appendText(this.clipText);this.movie.setFileName(this.fileName);this.movie.setAction(this.action);this.movie.setHandCursor(this.handCursorEnabled);break;case'mouseover':if(this.domElement&&this.cssEffects){if(this.recoverActive){this.domElement.addClass('active');}}
break;case'mouseout':if(this.domElement&&this.cssEffects){this.recoverActive=false;if(this.domElement.hasClass('active')){this.domElement.removeClass('active');this.recoverActive=true;}
}
break;case'mousedown':if(this.domElement&&this.cssEffects){this.domElement.addClass('active');}
break;case'mouseup':if(this.domElement&&this.cssEffects){this.domElement.removeClass('active');this.recoverActive=false;}
break;}
if(this.handlers[eventName]){for(var idx=0,len=this.handlers[eventName].length;idx<len;idx++){var func=this.handlers[eventName][idx];if(typeof(func)=='function'){func(this,args);}
else if((typeof(func)=='object')&&(func.length==2)){func[0][func[1]](this,args);}
else if(typeof(func)=='string'){window[func](this,args);}}}}};ZeroClipboard_TableTools.hasFlash=function()
{try{var fo=new ActiveXObject('ShockwaveFlash.ShockwaveFlash');if(fo){return true;}}
catch(e){if(navigator.mimeTypes&&navigator.mimeTypes['application/x-shockwave-flash']!==undefined&&navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin){return true;}}
return false;};window.ZeroClipboard_TableTools=ZeroClipboard_TableTools;var _glue=function(flash,node)
{var id=node.attr('id');if(node.parents('html').length){flash.glue(node[0],'');}
else{setTimeout(function(){_glue(flash,node);},500);}};var _filename=function(config,incExtension)
{var filename=config.filename==='*'&&config.title!=='*'&&config.title!==undefined?config.title:config.filename;if(typeof filename==='function'){filename=filename();}
if(filename.indexOf('*')!==-1){filename=$.trim(filename.replace('*',$('title').text()));}
filename=filename.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,"");return incExtension===undefined||incExtension===true?filename+config.extension:filename;};var _sheetname=function(config)
{var sheetName='Sheet1';if(config.sheetName){sheetName=config.sheetName.replace(/[\[\]\*\/\\\?\:]/g,'');}
return sheetName;};var _title=function(config)
{var title=config.title;if(typeof title==='function'){title=title();}
return title.indexOf('*')!==-1?title.replace('*',$('title').text()||'Exported data'):title;};var _setText=function(flash,data)
{var parts=data.match(/[\s\S]{1,8192}/g)||[];flash.clearText();for(var i=0,len=parts.length;i<len;i++)
{flash.appendText(parts[i]);}};var _newLine=function(config)
{return config.newline?config.newline:navigator.userAgent.match(/Windows/)?'\r\n':'\n';};var _exportData=function(dt,config)
{var newLine=_newLine(config);var data=dt.buttons.exportData(config.exportOptions);var boundary=config.fieldBoundary;var separator=config.fieldSeparator;var reBoundary=new RegExp(boundary,'g');var escapeChar=config.escapeChar!==undefined?config.escapeChar:'\\';var join=function(a){var s='';for(var i=0,ien=a.length;i<ien;i++){if(i>0){s+=separator;}
s+=boundary?boundary+(''+a[i]).replace(reBoundary,escapeChar+boundary)+boundary:a[i];}
return s;};var header=config.header?join(data.header)+newLine:'';var footer=config.footer&&data.footer?newLine+join(data.footer):'';var body=[];for(var i=0,ien=data.body.length;i<ien;i++){body.push(join(data.body[i]));}
return{str:header+body.join(newLine)+footer,rows:body.length};};var flashButton={available:function(){return ZeroClipboard_TableTools.hasFlash();},init:function(dt,button,config){ZeroClipboard_TableTools.moviePath=DataTable.Buttons.swfPath;var flash=new ZeroClipboard_TableTools.Client();flash.setHandCursor(true);flash.addEventListener('mouseDown',function(client){config._fromFlash=true;dt.button(button[0]).trigger();config._fromFlash=false;});_glue(flash,button);config._flash=flash;},destroy:function(dt,button,config){config._flash.destroy();},fieldSeparator:',',fieldBoundary:'"',exportOptions:{},title:'*',filename:'*',extension:'.csv',header:true,footer:false};function createCellPos(n){var ordA='A'.charCodeAt(0);var ordZ='Z'.charCodeAt(0);var len=ordZ-ordA+1;var s="";while(n>=0){s=String.fromCharCode(n%len+ordA)+s;n=Math.floor(n/len)-1;}
return s;}
function _createNode(doc,nodeName,opts){var tempNode=doc.createElement(nodeName);if(opts){if(opts.attr){$(tempNode).attr(opts.attr);}
if(opts.children){$.each(opts.children,function(key,value){tempNode.appendChild(value);});}
if(opts.text){tempNode.appendChild(doc.createTextNode(opts.text));}}
return tempNode;}
function _excelColWidth(data,col){var max=data.header[col].length;var len,lineSplit,str;if(data.footer&&data.footer[col].length>max){max=data.footer[col].length;}
for(var i=0,ien=data.body.length;i<ien;i++){var point=data.body[i][col];str=point!==null&&point!==undefined?point.toString():'';if(str.indexOf('\n')!==-1){lineSplit=str.split('\n');lineSplit.sort(function(a,b){return b.length-a.length;});len=lineSplit[0].length;}
else{len=str.length;}
if(len>max){max=len;}
if(max>40){return 52;}}
max*=1.3;return max>6?max:6;}
var _serialiser="";if(typeof window.XMLSerializer==='undefined'){_serialiser=new function(){this.serializeToString=function(input){return input.xml}};}else{_serialiser=new XMLSerializer();}
var _ieExcel;function _xlsxToStrings(obj){if(_ieExcel===undefined){_ieExcel=_serialiser.serializeToString($.parseXML(excelStrings['xl/worksheets/sheet1.xml'])).indexOf('xmlns:r')===-1;}
$.each(obj,function(name,val){if($.isPlainObject(val)){_xlsxToStrings(val);}
else{if(_ieExcel){var worksheet=val.childNodes[0];var i,ien;var attrs=[];for(i=worksheet.attributes.length-1;i>=0;i--){var attrName=worksheet.attributes[i].nodeName;var attrValue=worksheet.attributes[i].nodeValue;if(attrName.indexOf(':')!==-1){attrs.push({name:attrName,value:attrValue});worksheet.removeAttribute(attrName);}}
for(i=0,ien=attrs.length;i<ien;i++){var attr=val.createAttribute(attrs[i].name.replace(':','_dt_b_namespace_token_'));attr.value=attrs[i].value;worksheet.setAttributeNode(attr);}}
var str=_serialiser.serializeToString(val);if(_ieExcel){if(str.indexOf('<?xml')===-1){str='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+str;}
str=str.replace(/_dt_b_namespace_token_/g,':');}
str=str.replace(/<([^<>]*?) xmlns=""([^<>]*?)>/g,'<$1 $2>');obj[name]=str;}});}
var excelStrings={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+
'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'+
'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'+
'</Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+
'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'+
'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'+
'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'+
'</Relationships>',"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+
'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'+
'<Default Extension="xml" ContentType="application/xml" />'+
'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" />'+
'<Default Extension="jpeg" ContentType="image/jpeg" />'+
'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" />'+
'<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" />'+
'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" />'+
'</Types>',"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+
'<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'+
'<fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/>'+
'<workbookPr showInkAnnotation="0" autoCompressPictures="0"/>'+
'<bookViews>'+
'<workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/>'+
'</bookViews>'+
'<sheets>'+
'<sheet name="" sheetId="1" r:id="rId1"/>'+
'</sheets>'+
'</workbook>',"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+
'<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac">'+
'<sheetData/>'+
'</worksheet>',"xl/styles.xml":'<?xml version="1.0" encoding="UTF-8"?>'+
'<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac">'+
'<numFmts count="6">'+
'<numFmt numFmtId="164" formatCode="#,##0.00_-\ [$$-45C]"/>'+
'<numFmt numFmtId="165" formatCode="&quot;£&quot;#,##0.00"/>'+
'<numFmt numFmtId="166" formatCode="[$€-2]\ #,##0.00"/>'+
'<numFmt numFmtId="167" formatCode="0.0%"/>'+
'<numFmt numFmtId="168" formatCode="#,##0;(#,##0)"/>'+
'<numFmt numFmtId="169" formatCode="#,##0.00;(#,##0.00)"/>'+
'</numFmts>'+
'<fonts count="5" x14ac:knownFonts="1">'+
'<font>'+
'<sz val="11" />'+
'<name val="Calibri" />'+
'</font>'+
'<font>'+
'<sz val="11" />'+
'<name val="Calibri" />'+
'<color rgb="FFFFFFFF" />'+
'</font>'+
'<font>'+
'<sz val="11" />'+
'<name val="Calibri" />'+
'<b />'+
'</font>'+
'<font>'+
'<sz val="11" />'+
'<name val="Calibri" />'+
'<i />'+
'</font>'+
'<font>'+
'<sz val="11" />'+
'<name val="Calibri" />'+
'<u />'+
'</font>'+
'</fonts>'+
'<fills count="6">'+
'<fill>'+
'<patternFill patternType="none" />'+
'</fill>'+
'<fill/>'+
'<fill>'+
'<patternFill patternType="solid">'+
'<fgColor rgb="FFD9D9D9" />'+
'<bgColor indexed="64" />'+
'</patternFill>'+
'</fill>'+
'<fill>'+
'<patternFill patternType="solid">'+
'<fgColor rgb="FFD99795" />'+
'<bgColor indexed="64" />'+
'</patternFill>'+
'</fill>'+
'<fill>'+
'<patternFill patternType="solid">'+
'<fgColor rgb="ffc6efce" />'+
'<bgColor indexed="64" />'+
'</patternFill>'+
'</fill>'+
'<fill>'+
'<patternFill patternType="solid">'+
'<fgColor rgb="ffc6cfef" />'+
'<bgColor indexed="64" />'+
'</patternFill>'+
'</fill>'+
'</fills>'+
'<borders count="2">'+
'<border>'+
'<left />'+
'<right />'+
'<top />'+
'<bottom />'+
'<diagonal />'+
'</border>'+
'<border diagonalUp="false" diagonalDown="false">'+
'<left style="thin">'+
'<color auto="1" />'+
'</left>'+
'<right style="thin">'+
'<color auto="1" />'+
'</right>'+
'<top style="thin">'+
'<color auto="1" />'+
'</top>'+
'<bottom style="thin">'+
'<color auto="1" />'+
'</bottom>'+
'<diagonal />'+
'</border>'+
'</borders>'+
'<cellStyleXfs count="1">'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" />'+
'</cellStyleXfs>'+
'<cellXfs count="61">'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment horizontal="left"/>'+
'</xf>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment horizontal="center"/>'+
'</xf>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment horizontal="right"/>'+
'</xf>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment horizontal="fill"/>'+
'</xf>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment textRotation="90"/>'+
'</xf>'+
'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
'<alignment wrapText="1"/>'+
'</xf>'+
'<xf numFmtId="9"   fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="164" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="165" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="166" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="167" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="168" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="169" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="3" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'<xf numFmtId="4" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'+
'</cellXfs>'+
'<cellStyles count="1">'+
'<cellStyle name="Normal" xfId="0" builtinId="0" />'+
'</cellStyles>'+
'<dxfs count="0" />'+
'<tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" />'+
'</styleSheet>'};var _excelSpecials=[{match:/^\-?\d+\.\d%$/,style:60,fmt:function(d){return d/100;}},{match:/^\-?\d+\.?\d*%$/,style:56,fmt:function(d){return d/100;}},{match:/^\-?\$[\d,]+.?\d*$/,style:57},{match:/^\-?£[\d,]+.?\d*$/,style:58},{match:/^\-?€[\d,]+.?\d*$/,style:59},{match:/^\([\d,]+\)$/,style:61,fmt:function(d){return-1*d.replace(/[\(\)]/g,'');}},{match:/^\([\d,]+\.\d{2}\)$/,style:62,fmt:function(d){return-1*d.replace(/[\(\)]/g,'');}},{match:/^[\d,]+$/,style:63},{match:/^[\d,]+\.\d{2}$/,style:64}];DataTable.Buttons.swfPath='//cdn.datatables.net/buttons/1.2.4/swf/flashExport.swf';DataTable.Api.register('buttons.resize()',function(){$.each(ZeroClipboard_TableTools.clients,function(i,client){if(client.domElement!==undefined&&client.domElement.parentNode){client.positionElement();}});});DataTable.ext.buttons.copyFlash=$.extend({},flashButton,{className:'buttons-copy buttons-flash',text:function(dt){return dt.i18n('buttons.copy','Copy');},action:function(e,dt,button,config){if(!config._fromFlash){return;}
this.processing(true);var flash=config._flash;var data=_exportData(dt,config);var output=config.customize?config.customize(data.str,config):data.str;flash.setAction('copy');_setText(flash,output);this.processing(false);dt.buttons.info(dt.i18n('buttons.copyTitle','Copy to clipboard'),dt.i18n('buttons.copySuccess',{_:'Copied %d rows to clipboard',1:'Copied 1 row to clipboard'},data.rows),3000);},fieldSeparator:'\t',fieldBoundary:''});DataTable.ext.buttons.csvFlash=$.extend({},flashButton,{className:'buttons-csv buttons-flash',text:function(dt){return dt.i18n('buttons.csv','CSV');},action:function(e,dt,button,config){var flash=config._flash;var data=_exportData(dt,config);var output=config.customize?config.customize(data.str,config):data.str;flash.setAction('csv');flash.setFileName(_filename(config));_setText(flash,output);},escapeChar:'"'});DataTable.ext.buttons.excelFlash=$.extend({},flashButton,{className:'buttons-excel buttons-flash',text:function(dt){return dt.i18n('buttons.excel','Excel');},action:function(e,dt,button,config){this.processing(true);var flash=config._flash;var rowPos=0;var rels=$.parseXML(excelStrings['xl/worksheets/sheet1.xml']);var relsGet=rels.getElementsByTagName("sheetData")[0];var xlsx={_rels:{".rels":$.parseXML(excelStrings['_rels/.rels'])},xl:{_rels:{"workbook.xml.rels":$.parseXML(excelStrings['xl/_rels/workbook.xml.rels'])},"workbook.xml":$.parseXML(excelStrings['xl/workbook.xml']),"styles.xml":$.parseXML(excelStrings['xl/styles.xml']),"worksheets":{"sheet1.xml":rels}},"[Content_Types].xml":$.parseXML(excelStrings['[Content_Types].xml'])};var data=dt.buttons.exportData(config.exportOptions);var currentRow,rowNode;var addRow=function(row){currentRow=rowPos+1;rowNode=_createNode(rels,"row",{attr:{r:currentRow}});for(var i=0,ien=row.length;i<ien;i++){var cellId=createCellPos(i)+''+currentRow;var cell=null;if(row[i]===null||row[i]===undefined||row[i]===''){continue;}
row[i]=$.trim(row[i]);for(var j=0,jen=_excelSpecials.length;j<jen;j++){var special=_excelSpecials[j];if(row[i].match&&!row[i].match(/^0\d+/)&&row[i].match(special.match)){var val=row[i].replace(/[^\d\.\-]/g,'');if(special.fmt){val=special.fmt(val);}
cell=_createNode(rels,'c',{attr:{r:cellId,s:special.style},children:[_createNode(rels,'v',{text:val})]});break;}}
if(!cell){if(typeof row[i]==='number'||(row[i].match&&row[i].match(/^-?\d+(\.\d+)?$/)&&!row[i].match(/^0\d+/))){cell=_createNode(rels,'c',{attr:{t:'n',r:cellId},children:[_createNode(rels,'v',{text:row[i]})]});}
else{var text=!row[i].replace?row[i]:row[i].replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g,'');cell=_createNode(rels,'c',{attr:{t:'inlineStr',r:cellId},children:{row:_createNode(rels,'is',{children:{row:_createNode(rels,'t',{text:text})}})}});}}
rowNode.appendChild(cell);}
relsGet.appendChild(rowNode);rowPos++;};$('sheets sheet',xlsx.xl['workbook.xml']).attr('name',_sheetname(config));if(config.customizeData){config.customizeData(data);}
if(config.header){addRow(data.header,rowPos);$('row c',rels).attr('s','2');}
for(var n=0,ie=data.body.length;n<ie;n++){addRow(data.body[n],rowPos);}
if(config.footer&&data.footer){addRow(data.footer,rowPos);$('row:last c',rels).attr('s','2');}
var cols=_createNode(rels,'cols');$('worksheet',rels).prepend(cols);for(var i=0,ien=data.header.length;i<ien;i++){cols.appendChild(_createNode(rels,'col',{attr:{min:i+1,max:i+1,width:_excelColWidth(data,i),customWidth:1}}));}
if(config.customize){config.customize(xlsx);}
_xlsxToStrings(xlsx);flash.setAction('excel');flash.setFileName(_filename(config));flash.setSheetData(xlsx);_setText(flash,'');this.processing(false);},extension:'.xlsx'});DataTable.ext.buttons.pdfFlash=$.extend({},flashButton,{className:'buttons-pdf buttons-flash',text:function(dt){return dt.i18n('buttons.pdf','PDF');},action:function(e,dt,button,config){this.processing(true);var flash=config._flash;var data=dt.buttons.exportData(config.exportOptions);var totalWidth=dt.table().node().offsetWidth;var ratios=dt.columns(config.columns).indexes().map(function(idx){return dt.column(idx).header().offsetWidth/totalWidth;});flash.setAction('pdf');flash.setFileName(_filename(config));_setText(flash,JSON.stringify({title:_filename(config,false),message:typeof config.message=='function'?config.message(dt,button,config):config.message,colWidth:ratios.toArray(),orientation:config.orientation,size:config.pageSize,header:config.header?data.header:null,footer:config.footer?data.footer:null,body:data.body}));this.processing(false);},extension:'.pdf',orientation:'portrait',pageSize:'A4',message:'',newline:'\n'});return DataTable.Buttons;}));