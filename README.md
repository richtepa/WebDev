# Web Dev
With [Web Dev](https://assistant.google.com/services/a/id/6e3b4b0d7d1aebde/), users of the Google Assistant can ask for data from [caniuse.com](https://caniuse.com).

This data is provided by the [caniuse repository](https://github.com/Fyrd/caniuse).


## Contributing
Feel free to contribute, for details check the issues.


## The Code
I use [Dialogflow.com](https://dialogflow.com) to resolve the user querys.


### Actions on Google Helper
I use my own little [helper](https://github.com/richtepa/google_assistant-api.ai-php_helper). When an intent is triggered, it executes the function in the [index.php](index.php) (after line 18).


### features.txt
In the [features.txt](features.txt) are all different entities for the caniuse-data. These features can be found in the [caniuse/features-json](https://github.com/Fyrd/caniuse/tree/master/features-json) directory.

This [features.txt](features.txt) (or better .csv) is structured following:

**Scheme**

<CODE>"FEATURE_NAME_FROM_CANIUSE", "FEATURE_NAME_FROM_CANIUSE", "FEATURE_SYNONYM", "FEATURE_SYNONYM", ...

"FEATURE_NAME_FROM_CANIUSE", "FEATURE_NAME_FROM_CANIUSE", "FEATURE_SYNONYM", "FEATURE_SYNONYM", ...</CODE>

**Example**

<CODE>"addeventlistener", "addeventlistener", "addeventlisteners", "eventlistener", "eventlisteners", "listener", "listeners"

"alternate-stylesheet", "alternate-stylesheet", "alternate-stylesheet", "stylesheet", "stylesheets"</CODE>


### browsers.txt

This [browsers.txt](browsers.txt) is structured like the features.txt, but uses the browser-names:

**Scheme**

<CODE>"BROWSER_NAME_FROM_CANIUSE", "BROWSER_NAME_FROM_CANIUSE", "BROWSER_SYNONYM", "BROWSER_SYNONYM", ...

"BROWSER_NAME_FROM_CANIUSE", "BROWSER_NAME_FROM_CANIUSE", "BROWSER_SYNONYM", "BROWSER_SYNONYM", ...</CODE>

**Example**

<CODE>"edge","edge","microsoft edge"

"ie","ie","internet explorer"</CODE>


### actionsongooglesettings.md
I use the data from the [actionsongooglesettings.md](actionsongooglesettings.md) to deploy my app.


### privacypolicy.html
The [privacypolicy.html](privacypolicy.html) is needed for deployment. (Not beautiful but have the information)

