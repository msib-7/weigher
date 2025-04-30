<div class="row row-cols-3 d-flex justify-content-center">
    <?php    $no = 1; ?>
    <?php    $tableNo = 1; ?>
    @foreach (array_chunk($dataGroup->toArray(), 10) as $chunk)
        <div class="col">
            <div class="table-responsive">
                <table
                    class="table table-hover table-rounded table-striped border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-500">
                            <th class="text-center"><i>#</i></th>
                            <th class="text-center">No.Tablet</th>
                            <th class="text-center">Datetime</th>
                            <th class="text-center">Weight</th>
                            <th class="text-center">IPC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $item['no'] }}</td>
                                <td class="text-center">{{ $item['datetime'] }}</td>
                                <td class="text-center">{{ $item['weight'] }}</td>
                                <td class="text-center">{{ $item['ipc'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-semibold fs-6 text-gray-800 border border-top-2 border-gray-300 text-center">
                            <td colspan="5">Table-{{ $tableNo++ }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endforeach
</div>
<div class="row mt-5 d-flex justify-content-center">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" style="">
                    <tbody>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    N
                                </span>
                            </td>
                            <td>
                                <span class="n-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    X
                                </span>
                            </td>
                            <td>
                                <span class="x-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    S_DEV
                                </span>
                            </td>
                            <td>
                                <span class="s_dev-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    S_REL
                                </span>
                            </td>
                            <td>
                                <span class="s_rel-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    MIN
                                </span>
                            </td>
                            <td>
                                <span class="min-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    MAX
                                </span>
                            </td>
                            <td>
                                <span class="max-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    DIFF
                                </span>
                            </td>
                            <td>
                                <span class="diff-tengah">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fs-5 fw-bold">
                                    SUM
                                </span>
                            </td>
                            <td>
                                <span class="sum-tengah">0</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>