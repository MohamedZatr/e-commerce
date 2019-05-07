<?php
function lang($phases)
{
	static $lang = array
						(                    
        
//NavBar Links
          'HOME'                => 'Home',
          'CATEGORIES'          => 'Categories',
          'ITMES'               => 'Items',
          'MEMBERS'             => 'Members',
          'COMMENTS'            => 'Comments',
          'STATISTICS'          => 'Statistics',
          'LOGS'                => 'Logs',
          'EDITE_PROFILE'       => 'Edite Profile',
          'SETTING'             => 'Settings',
          'LOGOUT'              => 'Logout',
        

// Page Title
          'LOGIN'               => 'Login',
          'HOME_PAGE'           => 'Home Page',
          'MANGE_MEMBER'        => 'Mange Member',
          'ACTIVE_MEMBER'       => 'Active Member',
        
//Form in Edite Member And Add Member
            'USERNAME'               => 'User Name',                     
            'PASSWORD'               => 'Password',
            'LEAVE'                  => 'Leave Blanke If You Don\'t Change',
            'EMAIL'                  => 'E-mail',
            'FULLNAME'               => 'Full Name',
            'SAVE'                   => 'Save',
            'BTN_ADD'                => 'Add Member',
//Form in Edite Categories And Add Categories
            'CAT_NAME'               => 'Category Name',
            'CAT_DESCRIOTION'        => 'Description',
            'CAT_ORDERING'           => 'ordering',
            'CAT_VISIBILTY'          => 'Visiable',
            'CAT_ALLOW_COMMENT'      => 'Allow_comment',
            'CAT_ALLOW_ADS'          => 'Allow Ads',
//Addresses Of Form
           'EDITE_MEMBER'            => 'Edite Member',
           'ADD_MEMBER'              => 'Add Member',
           'MANAGE_MEMBER'           => 'Manage Member',
           'DELETE_MEMBER'           => 'Delete Member',
// Erorr Message Validation in From
            
        // USER NAME ERRORS
              'UN_EMPTY'             => 'User Name <strong>Can\'t Be Empty</strong>',
              'UN_LEGTH'             => 'User Name <strong>Can\'t Be legth less than 4 Charchter</strong>',
              'UN_MORE'              => 'User Name <strong>Can\'t Be More than 20 Charchter</strong>',
              'UN_NUMBER'            => 'User Name <strong>Can\'t Be Number</strong>',
              'UN_FOUND'             => 'The User Name Is Found',
            //PASSWORD ERRORS
              'PASS_EMPTY'           => 'Password <strong>Can\'t Be Empty</strong>',
              'PASS_LEGTH'           => 'Password <strong>Can\'t Be Legth than 8 Charchter And Must Be                            Have Charchter</strong>',
              'PASS_WITH_CHAR'        => 'Password <strong>Must Be Have Charchter</strong>',
            // E-MIAL ERRORS
              'MAIL_EMPTY'            => 'Email<strong> Can\'t Be Empty</strong>',
              'MAIL_FOUND'            => 'This Email Is Found',
            // FULL NAME ERRORS
              'FN_EMPTY'              => 'Full Name <strong>Can\'t Be Empty</strong>',
              'FN_NUMBER'             => 'Full Name <strong>Can\'t Be Number</strong>',
              
// Drop down list
              'EDITE_PROFILE'         => 'Edit Profile',
              'SETTING'               => 'Settings',
              'LOGOUT'                => 'Logout',
//Manage Page Table title
              'ID'                    => '#ID:- ',
              'USER_NAME'             => 'User Name',
              'EMAIL'                 => 'Email',
              'FULLNAME'              => 'Full Name',
              'REGISTER_DATE'         => 'Date',
              'REGISTER_STATUSE'      => 'Statuse',
              'CONTROLE'              => 'Control',
//Mange Page Control BTN
              'EDIT'                  => 'Edit',
              'DELETE'                => 'Delete',
              'ACTIVATE'               => 'Active',
// Message After Connect Data Base
              'SUCCESS_UPDATE'        => 'Record Update',
              'SUCCESS_INSERT'        => 'Record Insert',
              'SUCESS_DELETE'         => 'Record Delete',
              'SUCCESS_ACTIVE'        => 'Record Update And This User Can LogIn Now',
        
//Error Message
              'NO_PERMISSION'        => 'Sory You Can\'t Browse This Page Directly',
              'REDIRCT_PT1'          => 'You Will Be Redirected To ',
              'REDIRCT_PT2'          => ' After ',
              'REDIRCT_PT3'          => ' Seconds',
              'ERROR'                => 'Error!',
              'NOT_FOUND_ID'         => 'There Is No Such ID',
//Category error Form
              'CN_EMPTY'             => 'Category Name <strong>Can\'t Be Empty</strong>',
              'CN_LEGTH'             => 'Category Name <strong>Can\'t Be legth less than 4                                          Charchter</strong>',
              'ERROR_SAME'           => '<strong> Sory This Category Name Is Exist </strong>',
// Category Table
            'MANAGE_CAT'             => 'Manage Category',
            'CAT_NAME'               => 'Name:-',
            'CAT_DESCRIP'            => 'Description:-',
            'ORDRING'                => 'Ordering:-',
            'VISIBILITY'             => 'Visibilty:-',
            'ALLOW_COM'              => 'Allow_Com:-',
            'ALLOW_ADS'              => 'Allow_Ads:-',
    // items Page
           'MANGE_ITEMS'             => 'Items',
           'ITEM_NAME'               => 'Name',
           'ITEM_DESCRIP'            => 'Description',
           'ITEM_PRICE'              => 'Price',
           'ITEM_COUNTRY'            => 'Country',
           'ITEM_STATUS'             => 'Status',
           'ITEM_NEW'                => 'New',
           'ITEM_LIKE_NEW'           => 'Like New',
           'ITEM_USED'               => 'Used',
           'ITEM_OLD'                => 'Old',
           'ITEM_RATING'             => 'Rating',
//ERROR FORM IN ITME INSERT 
           'NAME_EMPTY'              => 'Name <strong>Can\'t Be Empty</strong>',
           'DESCRITION_EMPTY'        => 'Description <strong>Can\'t Be Empty</strong>',
           'PRICE_EMPTY'             => 'Price <strong>Can\'t Be Empty</strong>',
           'COUNTRY_EMPTY'           => 'Country <strong>Can\'t Be Empty</strong>',                 
           'NAME_NUM_CHAR'           => 'Name <strong>Can\'t Be legth less than 4 Charchter</strong>',
           'DESCRITION_NUM_CHAR'     => 'Description <strong>Can\'t Be legth less than 10                                              Charchter</strong>',
            'STATUS'                 => 'You Must Choose The Status',
           'ITEM_MRMBER'             => 'Member',
           'ITEM_CATEGORY'           => 'Category',
           'MEMBER_ERROR'            => 'You Must Choose <strong>The Member</strong>',
           'CATEGORY_ERROR'          => 'You Must Choose <strong>The Category</strong>',
        // Manage Items Page
           'MANAGE_ITEMS'            => 'Manage Items',
        // Table In Manage Page
           'ITEMS_ID'                => 'ID',   
           'ITEMS_NAME'              => 'Name',
           'ITEMS_DESCRIP'           => 'Descrip',
           'ITEMS_PRICE'             => 'Price',
           'ITEMS_DATE'              => 'Date',
           'ITEMS_CONTRY'            => 'Country',
           'ITEMS_STATUS'            => 'Status',
           'ITEMS_RATING'            => 'Rate',
           'ITEMS_CATEGORY'          => 'Category',
           'ITEMS_MEMBER'            => 'Add By',
           'SUCESS_ACTIVE_ITEM'      => 'This item is Approve And We Display It Now',
//Comments Page
        //Tilte h1
        'MANAGE_COMMENTS'            => 'Manage Comments',
        //Table Header
        'ID_COMMENT'                 => 'ID',
        'COMMENT_COMMENT'            => 'Comment',
        'STATUE_COMMENT'             => 'Statu',
        'DATE_COMMENT'               => 'Date',
        'ITEM_COMMENT'               => 'Item',
        'ADDBY_COMMENT'              => 'Add By',
        //Update Page
        'UPDATE_COMMENT'             => 'Update Comment',
        // Comment Error
        'ERROR_COMMENT'              => 'Comment <strong>Can\'t Be Empty</strong>',
        //Approve Page
        'APPROVE_COMMENT'            => 'Approve Comment',
        'APPROVE_COMMENT_MSG'        => 'This Comment is Approved And We display it',
        //Delete Page
        'DELETE_COMMENT'             => 'Delete Comment',
        'DELETE_COMMENT_MSG'         => 'This comment is Deleted',
        
  );
    
   
    
	return $lang[$phases];
}
