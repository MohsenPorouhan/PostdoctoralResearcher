var mode = 1
var FarsiCode   = new Array(63,1568,1569,1570,1571,1572,1573,109,104,102,1577,106,101,113,112,111,110,98,118,99,115,97,119,113,120,122,117,121,1595,1596,1597,1598,1599,1600,116,114,91,103,108,107,105,76,100,132,1611,1612,1613,1614,1615,1616,1617,1618,1619,1620,1621,1622,1623,1623,1625,1626,1627,1628,1629,1630,1631,1632,1633,1634,1635,1636,1637,1638,1639,1640,1641,1642,1643,1644,1645,1646,1647,1648,1649,1650,1651,1652,1653,1654,1655,1656,1657,1658,1659,1660,1661,128,1663,1664,1665,1666,1667,1668,1669,125,1671,1672,1673,1674,1675,1676,1677,1678,1679,1680,1681,1682,1683,1684,1685,1686,1687,124,1689,1690,1691,1692,1693,1694,1695,1696,1697,1698,1699,1700,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,39,1712,1713,1714,1715,1716,1717,1718,1719,1720,1721,1722,1723,1724,1725,1726,1727,1728,1729,1730,1731,1732,1733,1734,1735,1736,1737,1738,1739,100)
var EnglishCode = new Array(1711,39,40,41,42,1608,45,46,44,48,49,50,51,52,53,54,55,56,57,47,1603,59,60,61,62,1567,1588,1584,1586,1610,1579,1576,1604,1570,1607,1578,1606,1605,1574,1583,1582,1581,1590,1602,1587,1601,85,1585,1589,1591,1594,1592,1580,1688,1670,94,95,1662,1588,1584,1586,1610,1579,1576,1604,1575,1607,1578,1606,1605,1574,1583,1582,1581,1590,1602,1587,1601,1593,1585,1589,1591,1594,1592)

function FarsiKeyDown(){
 if ((window.event.keyCode == 118) ) {
//	if ( ( window.event.shiftKey) && (window.event.altKey)){
		if ( mode == 0 ){
			mode = 1 
			window.defaultStatus="Farsi Mode"	
		}
		else{
		 	mode = 0 
			window.defaultStatus="Normal Mode (English)" 
		}	
		window.event.returnValue = false 
	return
	} 
	window.event.returnValue = true 
}
	

function FarsiKeyPress(){
	var key 
	key = window.event.keyCode
	//if( key > 127  return
	if (mode == 1)  if((key>38)&&(key<40)) window.event.keyCode=EnglishCode[key-39];
	if (mode == 1)  if(key==40) window.event.keyCode=41;
	if (mode == 1)  if((key>40)&&(key<42)) window.event.keyCode=EnglishCode[key-39];
	if (mode == 1)  if(key==42) window.event.keyCode=42;
	if (mode == 1)  if((key>42)&&(key<58)) window.event.keyCode=EnglishCode[key-39];
	if (mode == 1)  if((key>58)&&(key<62)) window.event.keyCode=EnglishCode[key-39];
	if (mode == 1)  if(key==62) window.event.keyCode=1644;
	if (mode == 1)  if(key==63) window.event.keyCode=1567;;
	if (mode == 1)  if((key>63)&&(key<123)) window.event.keyCode=EnglishCode[key-39];

	if ((mode == 1) && (key==1740) ) window.event.keyCode=1610
	if ( mode == 0) if((key>1566)&&(key<1741))window.event.keyCode=FarsiCode[key-1567];     
	
	window.event.returnValue= true
}
