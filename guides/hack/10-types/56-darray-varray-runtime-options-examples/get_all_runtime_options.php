<?hh // strict

namespace Hack\UserDocumentation\Types\VarrayDarrayRuntimeOptions;

use namespace HH\Lib\{Dict, Str};

/**
 * @example
 * hhvm.arr_prov_hack_arrays-----------------------------------> global_value(1), local_value(1), access(4)
 * hhvm.hack_arr_compat_array_producing_func_notices-----------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_array_key_cast-------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_array_plus-----------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_compare--------------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_compare_non_any_array------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_empty_string_promote-------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_implicit_varray_append-----------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_null_hack_array_key--------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_check_varray_promote-------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_compact_serialize_notices--------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_dv_cmp_notices-------------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_fb_serialize_hack_arrays_notices-------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_is_array_notices-----------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_is_vec_dict_notices--------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_notices--------------------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_serialize_notices----------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_type_hint_notices----------------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_compat_type_hint_polymorphism-----------------> global_value(), local_value(), access(4)
 * hhvm.hack_arr_dv_arrs---------------------------------------> global_value(), local_value(), access(4)
 */
function get_all_runtime_options(
): dict<string, shape(
    'global_value' => string,
    'local_value' => string,
    'access' => string,
)> {
    return \ini_get_all()
        |> Dict\filter_keys($$, $name ==> Str\contains($name, 'hack_arr'));
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
    require_once __DIR__.'/../../../../vendor/autoload.hack';
    \Facebook\AutoloadMap\initialize();

    foreach (get_all_runtime_options() as $name => $values) {
        echo Str\format(
            "%s> global_value(%s), local_value(%s), access(%s)\n",
            Str\pad_right($name, 60, '-'),
            $values['global_value'],
            $values['local_value'],
            $values['access'],
        );
    }
}
