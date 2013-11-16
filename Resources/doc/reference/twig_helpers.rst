Twig Helpers
============

Render timeline

.. code-block:: jinja

    {{ zapoyok_timelinejs_display(timeline, {min: min, max: max }) }}


Available Options
-----------------

- min : null
- max : null
- width:  100%
- height: auto
- minHeight: 300px
- style: dot|box (default : box)
- showNavigation true|false (default: true)
- animate: true|false (default : true)
- locale: XX (default: en)
    - Catalan, ca (aliases: ca_ES)
    - English, en (aliases: en_US, en_UK)
    - Dutch, nl (aliases: nl_NL, nl_BE)
    - French, fr (aliases: fr_FR, fr_BE, fr_CA)
    - German, de (aliases: de_DE, de_CH)
    - Danish, da (aliases: da_DK)
    - Russian, ru (aliases: ru_RU)
    - Spanish, es (aliases: es_ES)


The full documentation of the JavaScript library is available at the following address : http://almende.github.io/chap-links-library/js/timeline/doc/


