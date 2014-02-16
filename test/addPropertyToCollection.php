<?php
require_once '../files/utils/collectionUtil.php';
collectionUtil :: add_property_to_all_collection_objects("programs" , "comments" , ""); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "ranks" , ""); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "numOfRanks" , "0"); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "totalRankScore" , "0"); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "numOfComments" , "0"); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "displayInProgramPage" , false); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "precedence" , "99"); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "img" , ""); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "sonPrograms" , ""); 
collectionUtil :: add_property_to_all_collection_objects("programs" , "fatherProgram" , ""); 
//collectionUtil :: addPropertyToAllCollectionObjects("programs" , "programLocale" , "en_US"); 

?>