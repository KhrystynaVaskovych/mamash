@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@component('shop::emails.layouts.master')

@section('extra-css')
<style>
    ul, li {
        list-style: none !important;
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
    }
    a {
        text-decoration: none;
    }
    .top-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 1.2px;
        height: 50px;
        width: 100%;
        background-color: #212121;
    }

    /*.logo {*/
    /*    font-weight: bold;*/
    /*    font-size: 28px;*/
    /*    color: $white;*/
    /*    margin-right: 58px;*/
    /*}*/

    .top-nav ul {
        display: flex;
        justify-content: space-between;
        text-transform: uppercase;
        font-weight: 400;
        width: 100%;
    }
    .top-nav ul li {
        display: flex;
    }
    .top-nav ul li::after {
        content: ' |';
        color: #fff;
        margin-left: 20px;
    }
    .top-nav ul li:last-child::after {
        margin-left: 0;
        content: '';
     }
    .top-nav a {
        color: #fff;
    }
    .top-nav a:hover {
         color: #dfa46d;
     }
</style>
@endsection

    <div style="width: 100%;max-width: 600px; margin-left: auto; margin-right: auto;background-color: #fff;">
        <div style="height: 170px;background-color: #212121;padding: 0 30px;">
            <div style="height: 120px;display: flex;align-items: center;justify-content: center;">
                <a href="{{ config('app.url') }}">
                    @include ('shop::emails.layouts.logo')
                </a>
            </div>

            <div class="top-nav">
                <ul>
                    <li><a href="{{ config('app.url') }}">Товары</a></li>
                    <li><a href="{{ config('app.url') }}">Коллекции</a></li>
                    <li><a href="{{ config('app.url') }}">Подаркы</a></li>
                    <li><a href="{{ config('app.url') }}">О нас</a></li>
                    <li><a href="{{ config('app.url') }}">A</a></li>
                </ul>
            </div> <!-- end top-nav -->
        </div>

        <div style="padding: 0 30px;">
            <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                {{ __('shop::app.mail.order.heading') }}
            </span> <br>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    {{ __('shop::app.mail.order.dear', ['customer_name' => $order->customer_full_name]) }},
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    {!! __('shop::app.mail.order.greeting', [
                        'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #0041FF; font-weight: bold;">#' . $order->increment_id . '</a>',
                        'created_at' => $order->created_at
                        ])
                    !!}
                </p>
            </div>

            <div
                style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
                {{ __('shop::app.mail.order.summary') }}
            </div>

            <div
                style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 40px;">
                @if ($order->shipping_address)
                    <div style="line-height: 25px;">
                        <div style="font-weight: bold;font-size: 16px;color: #242424;">
                            {{ __('shop::app.mail.order.shipping-address') }}
                        </div>

                        <div>
                            {{ $order->shipping_address->name }}
                        </div>

                        <div>
                            {{ $order->shipping_address->address1 }}, {{ $order->shipping_address->state }}
                        </div>

                        <div>
                            {{ core()->country_name($order->shipping_address->country) }} {{ $order->shipping_address->postcode }}
                        </div>

                        <div>---</div>

                        <div style="margin-bottom: 40px;">
                            {{ __('shop::app.mail.order.contact') }} : {{ $order->shipping_address->phone }}
                        </div>

                        <div style="font-size: 16px;color: #242424;">
                            {{ __('shop::app.mail.order.shipping') }}
                        </div>

                        <div style="font-weight: bold;font-size: 16px;color: #242424;">
                            {{ $order->shipping_title }}
                        </div>
                    </div>
                @endif

                <div style="line-height: 25px;">
                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        {{ __('shop::app.mail.order.billing-address') }}
                    </div>

                    <div>
                        {{ $order->billing_address->name }}
                    </div>

                    <div>
                        {{ $order->billing_address->address1 }}, {{ $order->billing_address->state }}
                    </div>

                    <div>
                        {{ core()->country_name($order->billing_address->country) }} {{ $order->billing_address->postcode }}
                    </div>

                    <div>---</div>

                    <div style="margin-bottom: 40px;">
                        {{ __('shop::app.mail.order.contact') }} : {{ $order->billing_address->phone }}
                    </div>

                    <div style="font-size: 16px; color: #242424;">
                        {{ __('shop::app.mail.order.payment') }}
                    </div>

                    <div style="font-weight: bold;font-size: 16px; color: #242424;">
                        {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                    </div>
                </div>
            </div>

            <div class="section-content">
                <div class="table mb-20">
                    <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                        <thead>
                        <tr style="background-color: #f2f2f2">
                            <th style="text-align: left;padding: 8px"></th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.price') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.qty') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($order->items as $item)
                            <?php
                            if ($item->type == "configurable")
                                $images = $productImageHelper->getProductBaseImage($item->child->product);
                            else
                                $images = $productImageHelper->getProductBaseImage($item->product);
                            ?>

                            <tr>
                                @if ($item->price > 0)
                                    <td style="text-align: left;padding: 8px"><img
                                            src="{{ $images['small_image_url'] }}"/></td>
                                    <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}"
                                        style="text-align: left;padding: 8px">{{ $item->getTypeInstance()->getOrderedItem($item)->sku }}</td>

                                    <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}"
                                        style="text-align: left;padding: 8px">
                                        {{ $item->name }}

                                        @if (isset($item->additional['attributes']))
                                            <div class="item-options">

                                                @foreach ($item->additional['attributes'] as $attribute)
                                                    <b>{{ $attribute['attribute_name'] }}
                                                        : </b>{{ $attribute['option_label'] }}</br>
                                                @endforeach

                                            </div>
                                        @endif
                                    </td>

                                    <td data-value="{{ __('shop::app.customer.account.order.view.price') }}"
                                        style="text-align: left;padding: 8px">{{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                    </td>

                                    <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}"
                                        style="text-align: left;padding: 8px">{{ $item->qty_ordered }}</td>
                                @else
                                    <td colspan="2" style="text-align: right;padding: 8px"><img
                                            src="{{ $images['small_image_url'] }}"/></td>
                                    <td colspan="3"
                                        data-value="{{ __('shop::app.customer.account.order.view.product-name') }}"
                                        style="display:flex;flex-direction: column;height: 100px;justify-content: center;align-content: center;flex-wrap: wrap;text-align: center;padding: 8px;">
                                        {{ $item->name }}
                                        <span
                                            style="color: #969696;font-weight: 500 !important;">{{ __('shop::app.customer.account.order.view.gift') }}</span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="font-size: 16px;color: #242424;line-height: 30px;float: right;width: 40%;margin-top: 20px;">
                <div>
                    <span>{{ __('shop::app.mail.order.subtotal') }}</span>
                    <span style="float: right;">
                    {{ core()->formatPrice($order->sub_total, $order->order_currency_code) }}
                </span>
                </div>

                @if ($order->shipping_address)
                    <div>
                        <span>{{ __('shop::app.mail.order.shipping-handling') }}</span>
                        <span style="float: right;">
                        {{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}
                    </span>
                    </div>
                @endif

                <div>
                    <span>{{ __('shop::app.mail.order.tax') }}</span>
                    <span style="float: right;">
                    {{ core()->formatPrice($order->tax_amount, $order->order_currency_code) }}
                </span>
                </div>

                @if ($order->discount_amount > 0)
                    <div>
                        <span>{{ __('shop::app.mail.order.discount') }}</span>
                        <span style="float: right;">
                        {{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}
                    </span>
                    </div>
                @endif

                <div style="font-weight: bold">
                    <span>{{ __('shop::app.mail.order.grand-total') }}</span>
                    <span style="float: right;">
                    {{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}
                </span>
                </div>
            </div>

            <div style="margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">
                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    {{ __('shop::app.mail.order.final-summary') }}
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    {!!
                        __('shop::app.mail.order.help', [
                            'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'
                            ])
                    !!}
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    {{ __('shop::app.mail.order.thanks') }}
                </p>
            </div>
        </div>
    </div>
@endcomponent
