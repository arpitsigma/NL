function cactusMasonry() {
	this.id;
	
	this.isIe9 = false;
	this.showLoader = true;
	this.infiniteScroll = true;
	this.fitWidth = false;
	this.forceAutoWidth = false;
	this.postsPerPage = 30;
	this.softGutter = 0;
	this.transitionDuration = 0;
	this.width = "auto";
	
	//Private stuff
	this.elems = Array();
	this.pageStart = 0;
	this.pageEnd = 0;
	this.pagePosition = 0;
	this.lastImageOffset = 0;
	this.loading = false;
	this.spinner = null;
	this.spinbox = null;
	this.spincontainer = null;
	this.msnry = null;
	this.opts = {
					lines: 13, // The number of lines to draw
					length: 0, // The length of each line
					width: 6, // The line thickness
					radius: 12, // The radius of the inner circle
					corners: 1, // Corner roundness (0..1)
					rotate: 0, // The rotation offset
					direction: 1, // 1: clockwise, -1: counterclockwise
					color: '#DFDFDF', // #rgb or #rrggbb or array of colors
					speed: 1.2, // Rounds per second
					trail: 100, // Afterglow percentage
					shadow: false, // Whether to render a shadow
					hwaccel: false, // Whether to use hardware acceleration
					className: 'spinner', // The CSS class to assign to the spinner
					zIndex: 2e9, // The z-index (defaults to 2000000000)
					top: '50%', // Top position relative to parent
					left: '50%' // Left position relative to parent
				};
}

/************************/
/*	PUBLIC FUNCTIONS	*/
/************************/
cactusMasonry.prototype.init = function(id, options) {	
	this.id = id;
	if(options.isIe9 != null) this.isIe9 = verifyBool(options.isIe9);
	if(options.showLoader != null) this.showLoader = verifyBool(options.showLoader);
	if(options.infiniteScroll != null) this.infiniteScroll = verifyBool(options.infiniteScroll);
	if(options.fitWidth != null) this.fitWidth = verifyBool(options.fitWidth);
	if(options.forceAutoWidth != null) this.forceAutoWidth = verifyBool(options.forceAutoWidth);
	if(options.postsPerPage != null) this.postsPerPage = options.postsPerPage;
	if(options.softGutter != null) this.softGutter = options.softGutter;
	if(options.transitionDuration != null) this.transitionDuration = options.transitionDuration;
	if(options.width != null) this.width = options.width;
	
	function verifyBool(b) {
		if(b === true || b === "true" || (b !== -1 && b !== false && b !== "false")) return true;
		return false;
	}
}

cactusMasonry.prototype.updateGallery = function() {
	this.msnry.layout();
}

cactusMasonry.prototype.drawGallery = function(elems) {
	this.elems = elems.slice();
	//Handle initiating the loading box
	if(this.showLoader) {
		this.spinner = new Spinner(this.opts);
		if(!this.isIe9) {
			this.spinbox = document.getElementById('MPG_Spin_Box');
			this.spinbox.style.width = '50px';
			this.spinbox.appendChild(this.spinner.spin().el);
		}
		this.spincontainer = document.getElementById('MPG_Loader_Container');
		this.spincontainer.style.display = 'block';
		this.spincontainer.style.opacity = '1';
	}
	//If there is anything to display - Start loading
	var elemSize = this.elems.length;
	if(elemSize > 0) {//this.elems = array of HTML elements containing masonry objects to add
		this.loading = true;	
		this.pageEnd = this.returnIfTrue(this.infiniteScroll, Math.min(elemSize, this.postsPerPage), elemSize);
		this.add_elem(0);//Start infinite scroll
	} else if(this.showLoader) {//Otherwise, nothing to see here
		document.getElementById('MPG_Loader_Container').style.display = 'none';
	}	
}

/************************/
/*	PRIVATE FUNCTIONS	*/
/************************/		

cactusMasonry.prototype.returnIfTrue = function(test, textIfTrue, textIfFalse) {
		if(textIfFalse === 'undefined') textIfFalse = "";
		if(test === true) return textIfTrue;
		return textIfFalse;
	}
	
	
//Add an element to the masonry display
cactusMasonry.prototype.add_elem = function(count) {
	this.loading = true;
	document.getElementById(this.id).appendChild(this.elems[count]);//Add element
	//Once the appended image has loaded:
	imagesLoaded('#'+this.id, function() {//Apply masonry to newly loaded image
		this.msnry = new Masonry('#'+this.id, {"columnWidth": this.returnIfTrue(this.forceAutoWidth, this.getColumnWidth(), this.returnIfTrue((this.width !== 'auto'), ".masonry_brick", this.getColumnWidth())), "stamp": ".masonry_stamp", "itemSelector": ".masonry_brick", "gutter": this.softGutter, "isFitWidth": this.fitWidth, "transitionDuration": this.transitionDuration});
		this.elems[count].style.transition = 'opacity 0.5s';
		this.elems[count].style.opacity = '1';
		if(count+1 < this.elems.length && (!this.infiniteScroll || this.pagePosition < this.pageEnd)) {
			if(this.endOfPage(this.getOffsetTop(this.elems[count]))) {
				this.pageEnd = this.returnIfTrue(this.infiniteScroll, Math.min(this.elems.length, this.pageEnd+1), this.elems.length);
			}
			this.pagePosition++;
			this.add_elem(count+1);
			if(this.showLoader) document.getElementById('MPG_Loader').innerHTML = 'Loading (' + ((((count-this.pageStart)/(this.pageEnd-this.pageStart))*100) | 0) + '%)';
		} else {
			if(this.showLoader) {
				document.getElementById('MPG_Loader').innerHTML = 'Loaded (100%)';
				document.getElementById('MPG_Loader_Container').style.opacity = '0';
				if(this.isIe9) {
					document.getElementById('MPG_Loader_Container').style.visibility = 'hidden';
				}	
				if(!this.isIe9) this.spinner.stop();
			}
			if(this.infiniteScroll) {
				if(this.pagePosition+1 < this.elems.length) {
					this.pageStart = this.pageEnd;
					this.pageEnd = Math.min(this.pageStart + this.postsPerPage,this.elems.length);
					this.lastImageOffset = this.getOffsetTop(this.elems[count]);
					window.onscroll = this.scrollListener.bind(this);
				}
			}
			this.loading = false;
		}
	}.bind(this));
}

cactusMasonry.prototype.getOffsetTop = function(el) {
	var y = 0;
	while(el && !isNaN(el.offsetLeft) && !isNaN(el.offsetTop)) {
		y += el.offsetTop - el.scrollTop;
		el = el.offsetParent;	
	}
	return y;
}
cactusMasonry.prototype.endOfPage = function(datum) {
	if(typeof(window.innerHeight) == 'number') return (window.pageYOffset + window.innerHeight*1.25 >= datum);//Everyone
	return (document.documentElement.scrollTop + document.documentElement.clientHeight*1.25 >= datum);//IE8
}

cactusMasonry.prototype.scrollListener = function(e) {
	this.loadNextSection();
}

cactusMasonry.prototype.loadNextSection = function() {
	if(this.endOfPage(this.lastImageOffset)) {
		this.loading = true;
		if(this.showLoader) {
			if(!this.isIe9) document.getElementById('MPG_Spin_Box').appendChild(this.spinner.spin().el);
			else document.getElementById('MPG_Loader_Container').style.visibility = 'visible';
			document.getElementById('MPG_Loader_Container').style.opacity = '1';
		}
		window.onscroll = null;
		this.add_elem(this.pagePosition);
	}
}
	
//The greatest common denominator
cactusMasonry.prototype.gcd = function (o) {
	if(!o.length) return 0;
	for(var r, a, i = o.length - 1, b = o[i]; i;) for(a = o[--i]; r = a % b; a = b, b = r);
	return b;
}

//Get the widths of columns.  This is used to set the col_width to the highest amount possible to improve masonry performance
cactusMasonry.prototype.getColumnWidth = function () {
	var colWidths = new Array();
	var els = null;
	if(this.isIe9) els = document.querySelector('.masonry_brick'); //Slow but supported by IE8
	else els = document.getElementsByClassName('masonry_brick'); //getElements has much better performance
	for(var o = 0; o < els.length; o++) {
		colWidths.push(els[o].offsetWidth);
	}
	return this.gcd(colWidths);	
}