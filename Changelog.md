# Changelog
Please READ this changelog before performing the update on your current Framework Version.


In order to update the your Framework Version from ( 1.0.- 1.2.- 2.0.0 ) to ( The Current Version ) you're subject to read the following doc.
- This update has a brand new features and improvments.
- This update is not beta.

## Requirements
Each Version of this Framework may require new modules or extensions to be available on your server.

- Server
    - If localhost ( Please install Ampps or AppServ )
- PHP
    - Version 5.6 or Newer
    - Tokenizer ( PHP Module )
- Apache
    - Mode_Rewrite ( Apache Module )





## Whats New?
- Features
    - Auto Load ( Controllers )
    - Pre-Installation Check ( Extensions )
    - Native Controllers Compiler
    - SQL Manager ( The Advanced Query Builder )
    - DBObject ( Advanced stdSQL Manager )
    - Developer Console ( Improved )
    - Brand new Console for Debugging
    - Multi-Languages ( Is now supported )
    - New Internal Functions
    - Brand new Page Navigator
    - Auto Detection of ( Controllers, Models, Helpers ) associated for the Viewer.
    - More +9 Features..
- Improvements
    - Main Core ( Improvements )
    - Main Controller ( Improvements )
    - Auto Loader ( Improvements )
    - Firewall ( Improvements )
    - Caching System ( Improvements )
    - Performance ( Bugs Fixed )
    - MySQL(i) Objective Controller ( Improvements )
    - More Improvements And fixes..


## Changes

Each change between versions will be shown here.

### Version 2.2.0

Global Updates :
  - Firewall Whitelisted URLs Feature Added.
  - Performance Improvements

Libraries :
  - MessengerBot Library Added.
  - IDateTime Library Added.
  - Google reCAPTCHA v2 Added.
  - Benchmark Library Added.
  - Password Policy Added.
  - File Streaming Library Added.
  - File Uploader Library Added.
  - Carbon DateTime Added.
  - User Agent Library Added.
  - JSONP Validation Added.

Engines :
  - SQL Manager Improved.
  - DBObject Improved.

Core :
  - Development Tools Improved.
  - Services Loader Improved.
  - Namespaces Support.



#### Changes

##### FROM Version 1.* to 2.*

FILES & FOLDERS :
  - New Settings folder - (Application/Misc/Config)
  - File (~root/Router.php) File moved to (Application/Misc/Config/Routes.php)
  - Firewall Settings File is here : (Application/Misc/Config/Firewall.php)
  - Terminal Settings File is here : (Application/Misc/Config/Terminal.php)

THINGS TO DO :
  - Controllers Settings are not available in (Application/Misc/Config/Routes.php)
    - You need to set the DEFAULT_CONTROLLER of your Application.
    - By default, this option set to (Home) Controller.


## How to perform the Update?
Using your browser or Git.

```sh
 $ git clone https://github.com/Skytells/Framework.git
```
