<?php

/**
 * Themes/FocusDefaultTheme/config/init.php
 */

return [

    /**
     * A sablon aktiválásakor az alábbi konfigurációs kulcsok alapján
     * opciók kerülnek létrehozásra az `options` táblában, ha még nem léteznek.
     *
     * A tömb elemei konfigurációs útvonalak (config path).
     *
     * Feldolgozási szabályok:
     *
     * - Ha a config path `validation_rules.options.*` formátumú,
     *   akkor a konfigurációban található kulcsok kerülnek létrehozásra
     *   az `options` táblában, alapértelmezett értékként `null`-lal.
     *
     * - Egyéb konfiguráció esetén a config tömb kulcsai kerülnek
     *   létrehozásra az `options` táblában, a konfigurációban
     *   megadott értékkel.
     *
     * Példa:
     *
     * 'initialized_options' => [
     *     'theme.theme.defaults',
     *     'theme.validation_rules.options.sidebars',
     * ]
     *
     * A sablon eltávolításakor (`theme:remove`) az itt felsorolt
     * konfigurációk alapján létrehozott opciók az adatbázisból
     * törlésre kerülnek.
     */
    'initialized_options' => [
        'theme.theme.defaults',
        'theme.validation_rules.options.sidebars',
    ]

];