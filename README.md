# Trew Knowledge Code Test
## Purpose
The code sample was developed with the intention to cover important and most frequently used functionalities in web development set up .

## Concept covered in this example 

1: Plugin development  

2: Gutenberg block  

3: React and custom API end point  

4: Working with input field “Select”  and on change provide preview on the fly

 

## Summary 
A plugin is built to introduce a new Featured Author Callout block. 
Using this block anywhere (pages or posts ) a user can add some detail about an author or user and can access their post with a link.

## Use case 
This block will be helpful when you want to relate somebody else work with an author’s existing work
Or you can just use this as a template to provide the info about an author on its own work.


## Code

### Files:

**Featured-author.php** : Main Plugin file , Contain php class and responsible for initialization and registration of all sorts of block related functionalities.  

**Block.json** :  To register block type as this is recommended practice. Also there are other ways to register scripts according to situations.  

**package.json** : To keep track of all the dependencies and requirements for the plugin.  

**Src** folder has two main files   
**Index.js**: where we register our block type JS side, Use react component to work with block admin side and front end side.   
**Index.scss**: For this example- all sorts of styling   

**Inc** folder has a PHP file “generateAuthorHTML.php” that output HTML for php render callback function   

**Build** folder is to provide compiled CSS and JSX for our component.   
### Test Cases
1: For the first time when a block is inserted into the page/post it should not have any author selected and there should not be a preview.  
2: If there is a milli seconds delay when we first inset the block a “Loading …” message will be displayed  
3: Preview will only be generated for valid user selection in drop down  
4: If we update the block and delete the author then HTML will be removed from the front end.  
5: Small screen view is also adjusted accordingly 
### Known Issue: 
For a production environment this block will require some more security checks and UI fixes.






