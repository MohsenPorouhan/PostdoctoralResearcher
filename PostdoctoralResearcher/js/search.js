function tabberact(i) {
	this.tab1.className='';
	this.tab2.className='';
	this.tab3.className='';
	this.tab4.className='';
	maininf.style.display='none';
	detailinfo.style.display='none';
	fncinfo.style.display='none';
	imggallery.style.display='none';
	if (i==1) {
	this.tab1.className='tabberactive';
	this.maininf.style.display='block';
	} else if (i==2) {
	this.tab2.className='tabberactive';
	detailinfo.style.display='block';
	} else if (i==3) {
	this.tab3.className='tabberactive';
	fncinfo.style.display='block';
	} else if (i==4) {
	this.tab4.className='tabberactive';
	imggallery.style.display='block';
	} 
}
