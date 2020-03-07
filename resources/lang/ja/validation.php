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

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeに正しいURLを入力してください。',
    'after' => ':attributeは:dateより先の日付を入力してください。',
    'after_or_equal' => ':attributeは:date以降の日付を入力してください。',
    'alpha' => ':attributeは英字で入力してください。',
    'alpha_dash' => ':attributeは英数字とハイフン、アンダーバーのみで入力してください。',
    'alpha_num' => ':attributeは英数字で入力してください。',
    'array' => ':attributeは配列で入力してください。',
    'before' => ':attributeは:dateより前の日付を入力してください。',
    'before_or_equal' => ':attributeは:date以前の日付を入力してください。',
    'between' => [
        'numeric' => ':attributeは:min〜:maxの範囲で入力してください。',
        'file' => ':attributeは:min〜:max KBのファイルを選択してください。',
        'string' => ':attributeは:min〜:max文字の範囲で入力してください。',
	'array' => ':attributeは:min〜:max個の範囲内にしてください。',
    ],
    'boolean' => ':attributeはtrueかfalseにしてください。',
    'confirmed' => ':attributeが確認用と一致しません。',
    'date' => ':attributeを正しい日付で入力してください。',
    'date_equals' => ':attributeを:dateと一致するよう入力してください。',
    'date_format' => ':attributeの書式を:formatに沿って入力してください。',
    'different' => ':attributeと:otherは違うものを入力してください。',
    'digits' => ':attributeは:digits桁で入力してください。',
    'digits_between' => ':attributeは:min〜:max桁で入力してください。',
    'dimensions' => ':attributeの画像サイズが不正です。',
    'distinct' => ':attributeが重複しています。',
    'email' => ':attributeを正しい形式で入力してください。',
    'ends_with' => ':attributeを:valuesで終わるよう入力してください。',
    'exists' => '選択した値が不正です。',
    'file' => ':attributeはファイルを選択してください。',
    'filled' => ':attributeを入力してください。',
    'gt' => [
        'numeric' => ':attributeは:valueより多く入力してください。',
        'file' => ':attributeは:value KBより大きいファイルを選択してください。',
        'string' => ':attributeは:value文字より多く入力してください。',
        'array' => ':attributeは:value個より多くしてください。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上で入力してください。',
        'file' => ':attributeは:value KB以上のファイルを選択してください。',
        'string' => ':attributeは:value文字以上入力してください。',
        'array' => ':attributeは:value個以上にしてください。',
    ],
    'image' => ':attributeは画像にしてください。',
    'in' => ':attributeは不正です。',
    'in_array' => ':attributeは:otherの範囲外です。',
    'integer' => ':attributeは数字で入力してください。',
    'ip' => ':attributeはIPアドレス形式で入力してください。',
    'ipv4' => ':attributeはIPv4形式で入力してください。',
    'ipv6' => ':attributeはIPv6形式で入力してください。',
    'json' => ':attributeはJSON形式で入力してください。',
    'lt' => [
	'numeric' => ':attributeは:valueより少なく入力してください。',
        'file' => ':attributeは:value KBより小さいファイルを選択してください。',
        'string' => ':attributeは:value文字より少なく入力してください。',
        'array' => ':attributeは:value個より少なくしてください。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下で入力してください。',
        'file' => ':attributeは:value KB以下のファイルを選択してください。',
        'string' => ':attributeは:value文字以下入力してください。',
        'array' => ':attributeは:value個以下にしてください。',
    ],
    'max' => [
        'numeric' => ':attributeは:max以下で入力してください。',
        'file' => ':attributeは:max KB以下のファイルを選択してください。',
        'string' => ':attributeは:max文字以下入力してください。',
        'array' => ':attributeは:max個以下にしてください。',
    ],
    'mimes' => ':attributeは:values形式で選択してください。',
    'mimetypes' => ':attributeは:values形式で選択してください。',
    'min' => [
        'numeric' => ':attributeは:min以上で入力してください。',
        'file' => ':attributeは:min KB以上のファイルを選択してください。',
        'string' => ':attributeは:min文字以上入力してください。',
        'array' => ':attributeは:min個以上にしてください。',
    ],
    'not_in' => ':attributeは不正です。',
    'not_regex' => ':attributeの書式が不正です。',
    'numeric' => ':attributeは数字で入力してください。',
    'present' => ':attributeは存在する必要があります。',
    'regex' => ':attributeの書式が不正です。',
    'required' => ':attributeを入力してください。',
    'required_if' => ':otherが:valueの時、:attributeを入力してください。',
    'required_unless' => ':otherが:valuesでない時、:attributeを入力してください。',
    'required_with' => ':valuesが存在する時、:attributeを入力してください。',
    'required_with_all' => ':valuesが存在する時、:attributeを入力してください。',
    'required_without' => ':valuesが存在しない時、:attributeを入力してください。',
    'required_without_all' => ':valuesが存在しない時、:attributeを入力してください。',
    'same' => ':attributeと:otherが一致するよう入力してください。',
    'size' => [
        'numeric' => ':attributeは:sizeで入力してください。',
	'file' => ':attributeは:size KBのファイルを選択してください。',
        'string' => ':attributeは:size文字で入力してください。',
        'array' => ':attributeは:size個にしてください。',
    ],
    'starts_with' => ':attributeを:valuesから始まるよう入力してください。',
    'string' => ':attributeは門司で入力してください。',
    'timezone' => ':attributeを正しいタイムゾーンで入力してください。',
    'unique' => ':attributeは既に取得されているため、違うものを入力してください。',
    'uploaded' => ':attributeはアップロードに失敗しました。',
    'url' => ':attributeを正しいURLで入力してください。',
    'uuid' => ':attributeを正しいUUIDで入力してください。',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'メールアドレス',
	'password' => 'パスワード',
    ],

];
