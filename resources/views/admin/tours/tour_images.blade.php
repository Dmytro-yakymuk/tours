@forelse($images as $img)   
    <table class="ssi-imgToUploadTable ssi-pending">
        <tbody>
            <tr>
                <td class="ssi-upImgTd">
                    <img class="ssi-imgToUpload" src="{{ asset('images/test/'. $img->name) }}">
                </td>
            </tr>
            <!-- <tr>
                <td>
                    <div id="ssi-uploadProgress0" class="ssi-hidden ssi-uploadProgress"></div>
                </td>
            </tr> -->
            <tr>
                <td>
                    <button type="button" data-delete="0" value="{{ $img->name }}" class="ssi-button error ssi-removeBtn">
                    <span class="trash10 trash"></span>
                </button>
                </td>
            </tr>
            <tr>
                <td>{{ $img->name }}</td>
            </tr>
        </tbody>
    </table>
@empty

@endforelse
