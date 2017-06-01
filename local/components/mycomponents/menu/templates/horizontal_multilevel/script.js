function CreateMymenu(ItemsDescr) {
	this.arItemsDescr = ItemsDescr;
	this.changeSectionPicure = function(element, itemId){
		var curLi = BX.findParent(element, {className: "root-li"});
		if (!curLi)
			return;
		
		var imgDescObj = curLi.querySelector("[data-role='desc-img-block']");
		if (!imgDescObj)
			return;
		var nameObj = BX.findChild(imgDescObj, {className: "title"}, true, false);
		if (nameObj)
			nameObj.innerHTML = mymenu.arItemsDescr[itemId]["NAME"];
		
		var imgObj = BX.findChild(imgDescObj, {tagName: "img"}, true, false);
		if (imgObj)
			imgObj.src = mymenu.arItemsDescr[itemId]["PICTURE"];

		var linkObjs = BX.findChild(imgDescObj, {tagName: "a"}, true, true);
		if (linkObjs)
		{
			changeAttr(linkObjs , 'href' ,mymenu.arItemsDescr[itemId]['DETAIL_PAGE_URL']);
			//linkObj.href = mymenu.arItemsDescr[itemId]['DETAIL_PAGE_URL'];
		}
		var descObj = BX.findChild(imgDescObj, {className: "count"}, true, false);
		if (descObj)
			descObj.innerHTML = mymenu.arItemsDescr[itemId]["SHOW_COUNTER"];

	};
	function changeAttr(Objs, attrName, value)
	{
		for(var i = 0; i < Objs.length; i++)
			Objs[i][attrName] = value;
	};
}

