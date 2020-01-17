<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n est pas un URL valide.',
    'after'                => 'Le champ :attribute doit être une date après :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date après ou ou égale à :date.',
    'alpha'                => 'Le champ :attribute doit contenir seuleument des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit contenir seuleument des lettres, nombres et tirets.',
    'alpha_num'            => 'Le champ :attribute doit contenir seuleument des lettres et des nombres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date avant :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date avant ou ou égale à :date.',
    'between'              => [
        'numeric' => 'Le champ :attribute doit être entre :min et :max.',
        'file'    => 'Le champ :attribute doit être entre :min et :max kilo-octets.',
        'string'  => 'Le champ :attribute doit être entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit avoir entre :min et :max itérations.',
    ],
    'boolean'              => 'Le champ :attribute le champ doit être vrai ou faux.',
    'confirmed'            => 'Le champ :attribute la confirmation ne correspond pas.',
    'date'                 => 'Le champ :attribute n est pas une date valide.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Le champ :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit être :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit être entre :min et :max chiffres.',
    'dimensions'           => 'Le champ :attribute a des dimensions d image invalides.',
    'distinct'             => 'Le champ :attribute a une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse e-mail valide.',
    'exists'               => 'Le champ :attribute sélectionné n est pas valide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute le champ doit avoir une valeur.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute sélectionné n est pas valide.',
    'in_array'             => 'Le champ :attribute n existe pas dans le champ :other.',
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champ :attribute doit être une chaîne JSON valide.',
    'max'                  => [
        'numeric' => 'Le champ :attribute ne doit pas être supérieur à than :max.',
        'file'    => 'Le champ :attribute ne doit pas être supérieur à :max kilo-octets.',
        'string'  => 'Le champ :attribute ne doit pas être supérieur à :max caractères.',
        'array'   => 'Le champ :attribute ne doit pas avoir plus de :max itérations.',
    ],
    'mimes'                => 'Le champ :attribute must be a file of type: :values.',
    'mimetypes'            => 'Le champ :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute must be at least :min.',
        'file'    => 'Le champ :attribute must be at least :min kilobytes.',
        'string'  => 'Le champ :attribute must be at least :min characters.',
        'array'   => 'Le champ :attribute must have at least :min items.',
    ],
    'not_in'               => 'Le champ :attribute sélectionné n est pas valide.',
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'present'              => 'Le champ :attribute le champ doit être présent.',
    'regex'                => 'Le champ :attribute a un format invalide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless'      => 'Le champ :attribute est obligatoire, sauf quand :other est dans :values.',
    'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all'    => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_without'     => 'Le champ :attribute est requis lorsque :values n est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucunes :values sont présents.',
    'same'                 => 'Le champ :attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => 'Le champ :attribute doit être :size.',
        'file'    => 'Le champ :attribute doit être :size kilo-octets.',
        'string'  => 'Le champ :attribute doit être :size caractères.',
        'array'   => 'Le champ :attribute doit contenir :size iterations.',
    ],
    'string'               => 'Le champ :attribute doit être une chaine.',
    'timezone'             => 'Le champ :attribute doit être une zone valide.',
    'unique'               => 'Le champ :attribute a déjà été prise.',
    'uploaded'             => 'Le champ :attribute n a pas téléchargé.',
    'url'                  => 'Le champ :attribute n est pas valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
