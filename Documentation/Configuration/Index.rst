.. include:: ../Includes.txt


.. _configuration:

=============
Configuration
=============

Target group: **Integrators**

Constants
===============
- Include jQuery (Default:false)
- Include jQuery ui (Default:true)
- Include formvalidator JS (Default:true)
- Include jQuery sortable (Default:true)
- Include Bootstrap CSS (Default:true)
- Include default CSS (Default:true)

Validation
===============

- Only jquery validation is available
- If you want to use the validation and don't have included jQuery, please activate "Include jQuery" in the Constant Editor
- You can use the validations provided on http://formvalidator.net/

Example of TypoScript to add a new validation:

.. code-block:: typoscript

   plugin.tx_formcreator_pi1 {
      settings{
         validations{
             # define here your validation (see http://formvalidator.net/)
             # example: User name (4 characters minimum, only alphanumeric characters):
             username = data-validation="length alphanumeric" data-validation-length="min4"
         }
      }
      _LOCAL_LANG{
         default {
	    validation{
               # this is the label shown in the selectbox for validations when you create a form
	       username = Username with 4 characters minimum
	    }
	 }
      }
   }

.. _configuration-typoscript:



