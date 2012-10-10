carrier_tracking
================

With this carrier tracking extension it is possible to let your clients track their shippings.

INSTALLATION<br>
To integrate this function to your shop, please follow the instructions in the README file. To create a new carrier, go to your admin panel -> master settings -> carriers. Here, you have to fill the fields with the necessary data. To assign a carrier to your shippings go to administer orders -> orders. Here, you shall enter the tracking code you got from your carrier. Assign the appropriate carrier from the appearing drop down box. Now the customer can track his order from the front end -> my orders. Tracking is dependend from the carrier's URI to the tracking site like this: https://www.dhl.de/oservices/t_u_t/OverViewList.jsp?sid=[TRACKING#] The TRACKING Nr. will be replaced by your database entry.

Originally posted in August 2010:
https://projects.oxidforge.org/projects/carriertracking
