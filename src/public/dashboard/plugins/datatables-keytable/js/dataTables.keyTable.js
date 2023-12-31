/*! KeyTable 2.6.4
 * ©2009-2021 SpryMedia Ltd - datatables.net/license
 */
(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net'],function($){return factory($,window,document);});}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window;}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$;}
return factory($,root,root.document);};}
else{factory(jQuery,window,document);}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;var namespaceCounter=0;var editorNamespaceCounter=0;var KeyTable=function(dt,opts){if(!DataTable.versionCheck||!DataTable.versionCheck('1.10.8')){throw'KeyTable requires DataTables 1.10.8 or newer';}
this.c=$.extend(true,{},DataTable.defaults.keyTable,KeyTable.defaults,opts);this.s={dt:new DataTable.Api(dt),enable:true,focusDraw:false,waitingForDraw:false,lastFocus:null,namespace:'.keyTable-'+(namespaceCounter++),tabInput:null};this.dom={};var settings=this.s.dt.settings()[0];var exisiting=settings.keytable;if(exisiting){return exisiting;}
settings.keytable=this;this._constructor();};$.extend(KeyTable.prototype,{blur:function()
{this._blur();},enable:function(state)
{this.s.enable=state;},enabled:function(){return this.s.enable;},focus:function(row,column)
{this._focus(this.s.dt.cell(row,column));},focused:function(cell)
{var lastFocus=this.s.lastFocus;if(!lastFocus){return false;}
var lastIdx=this.s.lastFocus.cell.index();return cell.row===lastIdx.row&&cell.column===lastIdx.column;},_constructor:function()
{this._tabInput();var that=this;var dt=this.s.dt;var table=$(dt.table().node());var namespace=this.s.namespace;var editorBlock=false;if(table.css('position')==='static'){table.css('position','relative');}
$(dt.table().body()).on('click'+namespace,'th, td',function(e){if(that.s.enable===false){return;}
var cell=dt.cell(this);if(!cell.any()){return;}
that._focus(cell,null,false,e);});$(document).on('keydown'+namespace,function(e){if(!editorBlock){that._key(e);}});if(this.c.blurable){$(document).on('mousedown'+namespace,function(e){if($(e.target).parents('.dataTables_filter').length){that._blur();}
if($(e.target).parents().filter(dt.table().container()).length){return;}
if($(e.target).parents('div.DTE').length){return;}
if($(e.target).parents('div.editor-datetime').length||$(e.target).parents('div.dt-datetime').length){return;}
if($(e.target).parents().filter('.DTFC_Cloned').length){return;}
that._blur();});}
if(this.c.editor){var editor=this.c.editor;editor.on('open.keyTableMain',function(e,mode,action){if(mode!=='inline'&&that.s.enable){that.enable(false);editor.one('close'+namespace,function(){that.enable(true);});}});if(this.c.editOnFocus){dt.on('key-focus'+namespace+' key-refocus'+namespace,function(e,dt,cell,orig){that._editor(null,orig,true);});}
dt.on('key'+namespace,function(e,dt,key,cell,orig){that._editor(key,orig,false);});$(dt.table().body()).on('dblclick'+namespace,'th, td',function(e){if(that.s.enable===false){return;}
var cell=dt.cell(this);if(!cell.any()){return;}
if(that.s.lastFocus&&this!==that.s.lastFocus.cell.node()){return;}
that._editor(null,e,true);});editor.on('preSubmit',function(){editorBlock=true;}).on('preSubmitCancelled',function(){editorBlock=false;}).on('submitComplete',function(){editorBlock=false;});}
if(dt.settings()[0].oFeatures.bStateSave){dt.on('stateSaveParams'+namespace,function(e,s,d){d.keyTable=that.s.lastFocus?that.s.lastFocus.cell.index():null;});}
dt.on('column-visibility'+namespace,function(e){that._tabInput();});dt.on('draw'+namespace,function(e){that._tabInput();if(that.s.focusDraw){return;}
var lastFocus=that.s.lastFocus;if(lastFocus){var relative=that.s.lastFocus.relative;var info=dt.page.info();var row=relative.row+info.start;if(info.recordsDisplay===0){return;}
if(row>=info.recordsDisplay){row=info.recordsDisplay-1;}
that._focus(row,relative.column,true,e);}});if(this.c.clipboard){this._clipboard();}
dt.on('destroy'+namespace,function(){that._blur(true);dt.off(namespace);$(dt.table().body()).off('click'+namespace,'th, td').off('dblclick'+namespace,'th, td');$(document).off('mousedown'+namespace).off('keydown'+namespace).off('copy'+namespace).off('paste'+namespace);});var state=dt.state.loaded();if(state&&state.keyTable){dt.one('init',function(){var cell=dt.cell(state.keyTable);if(cell.any()){cell.focus();}});}
else if(this.c.focus){dt.cell(this.c.focus).focus();}},_blur:function(noEvents)
{if(!this.s.enable||!this.s.lastFocus){return;}
var cell=this.s.lastFocus.cell;$(cell.node()).removeClass(this.c.className);this.s.lastFocus=null;if(!noEvents){this._updateFixedColumns(cell.index().column);this._emitEvent('key-blur',[this.s.dt,cell]);}},_clipboard:function(){var dt=this.s.dt;var that=this;var namespace=this.s.namespace;if(!window.getSelection){return;}
$(document).on('copy'+namespace,function(ejq){var e=ejq.originalEvent;var selection=window.getSelection().toString();var focused=that.s.lastFocus;if(!selection&&focused){e.clipboardData.setData('text/plain',focused.cell.render(that.c.clipboardOrthogonal));e.preventDefault();}});$(document).on('paste'+namespace,function(ejq){var e=ejq.originalEvent;var focused=that.s.lastFocus;var activeEl=document.activeElement;var editor=that.c.editor;var pastedText;if(focused&&(!activeEl||activeEl.nodeName.toLowerCase()==='body')){e.preventDefault();if(window.clipboardData&&window.clipboardData.getData){pastedText=window.clipboardData.getData('Text');}
else if(e.clipboardData&&e.clipboardData.getData){pastedText=e.clipboardData.getData('text/plain');}
if(editor){var options=that._inlineOptions(focused.cell.index());editor.inline(options.cell,options.field,options.options).set(editor.displayed()[0],pastedText).submit();}
else{focused.cell.data(pastedText);dt.draw(false);}}});},_columns:function()
{var dt=this.s.dt;var user=dt.columns(this.c.columns).indexes();var out=[];dt.columns(':visible').every(function(i){if(user.indexOf(i)!==-1){out.push(i);}});return out;},_editor:function(key,orig,hardEdit)
{if(!this.s.lastFocus){return;}
if(orig&&orig.type==='draw'){return;}
var that=this;var dt=this.s.dt;var editor=this.c.editor;var editCell=this.s.lastFocus.cell;var namespace=this.s.namespace+'e'+editorNamespaceCounter++;if($('div.DTE',editCell.node()).length){return;}
if(key!==null&&((key>=0x00&&key<=0x09)||key===0x0b||key===0x0c||(key>=0x0e&&key<=0x1f)||(key>=0x70&&key<=0x7b)||(key>=0x7f&&key<=0x9f))){return;}
if(orig){orig.stopPropagation();if(key===13){orig.preventDefault();}}
var editInline=function(){var options=that._inlineOptions(editCell.index());editor.one('open'+namespace,function(){editor.off('cancelOpen'+namespace);if(!hardEdit){$('div.DTE_Field_InputControl input, div.DTE_Field_InputControl textarea').select();}
dt.keys.enable(hardEdit?'tab-only':'navigation-only');dt.on('key-blur.editor',function(e,dt,cell){if(editor.displayed()&&cell.node()===editCell.node()){editor.submit();}});if(hardEdit){$(dt.table().container()).addClass('dtk-focus-alt');}
editor.on('preSubmitCancelled'+namespace,function(){setTimeout(function(){that._focus(editCell,null,false);},50);});editor.on('submitUnsuccessful'+namespace,function(){that._focus(editCell,null,false);});editor.one('close'+namespace,function(){dt.keys.enable(true);dt.off('key-blur.editor');editor.off(namespace);$(dt.table().container()).removeClass('dtk-focus-alt');if(that.s.returnSubmit){that.s.returnSubmit=false;that._emitEvent('key-return-submit',[dt,editCell]);}});}).one('cancelOpen'+namespace,function(){editor.off(namespace);}).inline(options.cell,options.field,options.options);};if(key===13){hardEdit=true;$(document).one('keyup',function(){editInline();});}
else{editInline();}},_inlineOptions:function(cellIdx)
{if(this.c.editorOptions){return this.c.editorOptions(cellIdx);}
return{cell:cellIdx,field:undefined,options:undefined};},_emitEvent:function(name,args)
{this.s.dt.iterator('table',function(ctx,i){$(ctx.nTable).triggerHandler(name,args);});},_focus:function(row,column,shift,originalEvent)
{var that=this;var dt=this.s.dt;var pageInfo=dt.page.info();var lastFocus=this.s.lastFocus;if(!originalEvent){originalEvent=null;}
if(!this.s.enable){return;}
if(typeof row!=='number'){if(!row.any()){return;}
var index=row.index();column=index.column;row=dt.rows({filter:'applied',order:'applied'}).indexes().indexOf(index.row);if(row<0){return;}
if(pageInfo.serverSide){row+=pageInfo.start;}}
if(pageInfo.length!==-1&&(row<pageInfo.start||row>=pageInfo.start+pageInfo.length)){this.s.focusDraw=true;this.s.waitingForDraw=true;dt.one('draw',function(){that.s.focusDraw=false;that.s.waitingForDraw=false;that._focus(row,column,undefined,originalEvent);}).page(Math.floor(row/pageInfo.length)).draw(false);return;}
if($.inArray(column,this._columns())===-1){return;}
if(pageInfo.serverSide){row-=pageInfo.start;}
var cells=dt.cells(null,column,{search:'applied',order:'applied'}).flatten();var cell=dt.cell(cells[row]);if(lastFocus){if(lastFocus.node===cell.node()){this._emitEvent('key-refocus',[this.s.dt,cell,originalEvent||null]);return;}
this._blur();}
this._removeOtherFocus();var node=$(cell.node());node.addClass(this.c.className);this._updateFixedColumns(column);if(shift===undefined||shift===true){this._scroll($(window),$(document.body),node,'offset');var bodyParent=dt.table().body().parentNode;if(bodyParent!==dt.table().header().parentNode){var parent=$(bodyParent.parentNode);this._scroll(parent,parent,node,'position');}}
this.s.lastFocus={cell:cell,node:cell.node(),relative:{row:dt.rows({page:'current'}).indexes().indexOf(cell.index().row),column:cell.index().column}};this._emitEvent('key-focus',[this.s.dt,cell,originalEvent||null]);dt.state.save();},_key:function(e)
{if(this.s.waitingForDraw){e.preventDefault();return;}
var enable=this.s.enable;this.s.returnSubmit=(enable==='navigation-only'||enable==='tab-only')&&e.keyCode===13?true:false;var navEnable=enable===true||enable==='navigation-only';if(!enable){return;}
if((e.keyCode===0||e.ctrlKey||e.metaKey||e.altKey)&&!(e.ctrlKey&&e.altKey)){return;}
var lastFocus=this.s.lastFocus;if(!lastFocus){return;}
if(!this.s.dt.cell(lastFocus.node).any()){this.s.lastFocus=null;return;}
var that=this;var dt=this.s.dt;var scrolling=this.s.dt.settings()[0].oScroll.sY?true:false;if(this.c.keys&&$.inArray(e.keyCode,this.c.keys)===-1){return;}
switch(e.keyCode){case 9:this._shift(e,e.shiftKey?'left':'right',true);break;case 27:if(this.c.blurable&&enable===true){this._blur();}
break;case 33:case 34:if(navEnable&&!scrolling){e.preventDefault();dt.page(e.keyCode===33?'previous':'next').draw(false);}
break;case 35:case 36:if(navEnable){e.preventDefault();var indexes=dt.cells({page:'current'}).indexes();var colIndexes=this._columns();this._focus(dt.cell(indexes[e.keyCode===35?indexes.length-1:colIndexes[0]]),null,true,e);}
break;case 37:if(navEnable){this._shift(e,'left');}
break;case 38:if(navEnable){this._shift(e,'up');}
break;case 39:if(navEnable){this._shift(e,'right');}
break;case 40:if(navEnable){this._shift(e,'down');}
break;case 113:if(this.c.editor){this._editor(null,e,true);break;}
default:if(enable===true){this._emitEvent('key',[dt,e.keyCode,this.s.lastFocus.cell,e]);}
break;}},_removeOtherFocus:function()
{var thisTable=this.s.dt.table().node();$.fn.dataTable.tables({api:true}).iterator('table',function(settings){if(this.table().node()!==thisTable){this.cell.blur();}});},_scroll:function(container,scroller,cell,posOff)
{var offset=cell[posOff]();var height=cell.outerHeight();var width=cell.outerWidth();var scrollTop=scroller.scrollTop();var scrollLeft=scroller.scrollLeft();var containerHeight=container.height();var containerWidth=container.width();if(posOff==='position'){offset.top+=parseInt(cell.closest('table').css('top'),10);}
if(offset.top<scrollTop){scroller.scrollTop(offset.top);}
if(offset.left<scrollLeft){scroller.scrollLeft(offset.left);}
if(offset.top+height>scrollTop+containerHeight&&height<containerHeight){scroller.scrollTop(offset.top+height-containerHeight);}
if(offset.left+width>scrollLeft+containerWidth&&width<containerWidth){scroller.scrollLeft(offset.left+width-containerWidth);}},_shift:function(e,direction,keyBlurable)
{var that=this;var dt=this.s.dt;var pageInfo=dt.page.info();var rows=pageInfo.recordsDisplay;var columns=this._columns();var last=this.s.lastFocus;if(!last){return;}
var currentCell=last.cell;if(!currentCell){return;}
var currRow=dt.rows({filter:'applied',order:'applied'}).indexes().indexOf(currentCell.index().row);if(pageInfo.serverSide){currRow+=pageInfo.start;}
var currCol=dt.columns(columns).indexes().indexOf(currentCell.index().column);var
row=currRow,column=columns[currCol];if($(dt.table().node()).css('direction')==='rtl'){if(direction==='right'){direction='left';}
else if(direction==='left'){direction='right';}}
if(direction==='right'){if(currCol>=columns.length-1){row++;column=columns[0];}
else{column=columns[currCol+1];}}
else if(direction==='left'){if(currCol===0){row--;column=columns[columns.length-1];}
else{column=columns[currCol-1];}}
else if(direction==='up'){row--;}
else if(direction==='down'){row++;}
if(row>=0&&row<rows&&$.inArray(column,columns)!==-1){if(e){e.preventDefault();}
this._focus(row,column,true,e);}
else if(!keyBlurable||!this.c.blurable){if(e){e.preventDefault();}}
else{this._blur();}},_tabInput:function()
{var that=this;var dt=this.s.dt;var tabIndex=this.c.tabIndex!==null?this.c.tabIndex:dt.settings()[0].iTabIndex;if(tabIndex==-1){return;}
if(!this.s.tabInput){var div=$('<div><input type="text" tabindex="'+tabIndex+'"/></div>').css({position:'absolute',height:1,width:0,overflow:'hidden'});div.children().on('focus',function(e){var cell=dt.cell(':eq(0)',that._columns(),{page:'current'});if(cell.any()){that._focus(cell,null,true,e);}});this.s.tabInput=div;}
var cell=this.s.dt.cell(':eq(0)','0:visible',{page:'current',order:'current'}).node();if(cell){$(cell).prepend(this.s.tabInput);}},_updateFixedColumns:function(column)
{var dt=this.s.dt;var settings=dt.settings()[0];if(settings._oFixedColumns){var leftCols=settings._oFixedColumns.s.iLeftColumns;var rightCols=settings.aoColumns.length-settings._oFixedColumns.s.iRightColumns;if(column<leftCols||column>=rightCols){dt.fixedColumns().update();}}}});KeyTable.defaults={blurable:true,className:'focus',clipboard:true,clipboardOrthogonal:'display',columns:'',editor:null,editOnFocus:false,editorOptions:null,focus:null,keys:null,tabIndex:null};KeyTable.version="2.6.4";$.fn.dataTable.KeyTable=KeyTable;$.fn.DataTable.KeyTable=KeyTable;DataTable.Api.register('cell.blur()',function(){return this.iterator('table',function(ctx){if(ctx.keytable){ctx.keytable.blur();}});});DataTable.Api.register('cell().focus()',function(){return this.iterator('cell',function(ctx,row,column){if(ctx.keytable){ctx.keytable.focus(row,column);}});});DataTable.Api.register('keys.disable()',function(){return this.iterator('table',function(ctx){if(ctx.keytable){ctx.keytable.enable(false);}});});DataTable.Api.register('keys.enable()',function(opts){return this.iterator('table',function(ctx){if(ctx.keytable){ctx.keytable.enable(opts===undefined?true:opts);}});});DataTable.Api.register('keys.enabled()',function(opts){var ctx=this.context;if(ctx.length){return ctx[0].keytable?ctx[0].keytable.enabled():false;}
return false;});DataTable.Api.register('keys.move()',function(dir){return this.iterator('table',function(ctx){if(ctx.keytable){ctx.keytable._shift(null,dir,false);}});});DataTable.ext.selector.cell.push(function(settings,opts,cells){var focused=opts.focused;var kt=settings.keytable;var out=[];if(!kt||focused===undefined){return cells;}
for(var i=0,ien=cells.length;i<ien;i++){if((focused===true&&kt.focused(cells[i]))||(focused===false&&!kt.focused(cells[i]))){out.push(cells[i]);}}
return out;});$(document).on('preInit.dt.dtk',function(e,settings,json){if(e.namespace!=='dt'){return;}
var init=settings.oInit.keys;var defaults=DataTable.defaults.keys;if(init||defaults){var opts=$.extend({},defaults,init);if(init!==false){new KeyTable(settings,opts);}}});return KeyTable;}));