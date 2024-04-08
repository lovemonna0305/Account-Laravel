<div class="py-3">
    <h3 class="fs-16 fw-700 mb-0">
        <span>{{ translate('Other Questions') }}</span>
    </h3>
</div>

<!-- Product queries -->
@forelse ($product_queries as $product_query)
    <div class="produc-queries mb-4">
        <div class="query d-flex  my-2">
            <span class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="36" viewBox="0 0 24 36">
                    <g id="Group_23928" data-name="Group 23928" transform="translate(-654 -2397)">
                      <path id="Path_28707" data-name="Path 28707" d="M0,0H24V24H0Z" transform="translate(654 2397)" fill="#d43533"/>
                      <text id="Q" transform="translate(666 2414)" fill="#fff" font-size="14" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="-4.833" y="0">Q</tspan></text>
                      <path id="Path_28708" data-name="Path 28708" d="M0,0H12L0,12Z" transform="translate(666 2421)" fill="#d43533"/>
                      <path id="Path_28711" data-name="Path 28711" d="M0,0H12L0,12Z" transform="translate(666 2421)" fill="#1b1b28" opacity="0.2"/>
                    </g>
                </svg>
            </span>
            <div class="ml-3 mt-0 p-0">
                <div class="fs-14">{{ strip_tags($product_query->question) }}</div>
                <span class="text-secondary">{{ $product_query->user->name }} </span>
            </div>
        </div>
        <div class="answer d-flex my-2">
            <span class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="36" viewBox="0 0 24 36">
                    <g id="Group_23929" data-name="Group 23929" transform="translate(-654 -2453)">
                      <path id="Path_28709" data-name="Path 28709" d="M0,0H24V24H0Z" transform="translate(654 2453)" fill="#f3af3d"/>
                      <text id="A" transform="translate(666 2470)" fill="#fff" font-size="14" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="-4.71" y="0">A</tspan></text>
                      <path id="Path_28710" data-name="Path 28710" d="M0,0H12L0,12Z" transform="translate(666 2477)" fill="#f3af3d"/>
                      <path id="Path_28712" data-name="Path 28712" d="M0,0H12L0,12Z" transform="translate(666 2477)" fill="#1b1b28" opacity="0.1"/>
                    </g>
                </svg>
            </span>
            <div class="ml-3 mt-0 p-0">
                <div class="fs-14">
                    {{ strip_tags($product_query->reply ? $product_query->reply : translate('Seller did not respond yet')) }}
                </div>
                <span class=" text-secondary"> {{ $product_query->product->user->name }}
                </span>
            </div>
        </div>
    </div>
@empty
    <p>{{ translate('No none asked to seller yet') }}</p>
@endforelse

<!-- Pagination -->
<div class="aiz-pagination product-queries-pagination py-2 d-flex justify-content-end">
    {{ $product_queries->links() }}
</div>
