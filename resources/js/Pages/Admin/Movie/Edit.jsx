import Checkbox from "@/Components/Checkbox";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import Authenticated from "@/Layouts/Authenticated/Index";
import { Head, useForm } from "@inertiajs/react";
import ValidationErrors from "@/Components/ValidationErrors";

export default function Edit({ auth, movie }) {
    const { data, setData, put, processing, errors } = useForm({
        ...movie
    });

    const submit = (e) => {
        e.preventDefault();

        if (data.thumbnail === movie.thumbnail) {
            delete data.thumbnail;
        }

        put(route("admin.dashboard.movie.update", movie.id), {
            _method: "PUT",
            ...data,
        });
    };

    return (
        <Authenticated auth={auth}>
            <Head title="Admin - Update Movie" />

            <h1 className="text-xl">Update Movie: {movie.name}</h1>
            <hr className="mb-4" />
            {/* <InputError message={errors.name} className="mt-2" /> */}
            <ValidationErrors errors={errors} />
            <form onSubmit={submit}>
                <InputLabel forinput="name" value="Name" />
                <TextInput
                    type="text"
                    name="name"
                    defaultValue={movie.name}
                    variant="primary-outline"
                    onChange={(e) => setData("name", e.target.value)}
                    placeholder="Enter the name of the movie"
                    isError={errors.name}
                />
                <InputLabel
                    forinput="category"
                    value="Category"
                    className="mt-4"
                />
                <TextInput
                    type="text"
                    name="category"
                    defaultValue={movie.category}
                    variant="primary-outline"
                    onChange={(e) => setData("category", e.target.value)}
                    placeholder="Enter the category of the movie"
                    isError={errors.category}
                />
                <InputLabel
                    forinput="video_url"
                    value="Video URL"
                    className="mt-4"
                />
                <TextInput
                    type="url"
                    name="video_url"
                    defaultValue={movie.video_url}
                    variant="primary-outline"
                    onChange={(e) => setData("video_url", e.target.value)}
                    placeholder="Enter the video url of the movie"
                    isError={errors.video_url}
                />
                <InputLabel
                    forinput="thumbnail"
                    value="Thumbnail"
                    className="mt-4"
                />
                <img
                    src={`/storage/${movie.thumbnail}`}
                    alt=""
                    className="w-40 ml-8"
                />
                <TextInput
                    type="file"
                    name="thumbnail"
                    variant="primary-outline"
                    onChange={(e) => setData("thumbnail", e.target.files[0])}
                    placeholder="Insert thumbnail of the movie"
                    isError={errors.thumbnail}
                />
                <InputLabel forinput="rating" value="Rating" className="mt-4" />
                <TextInput
                    type="number"
                    name="rating"
                    defaultValue={movie.rating}
                    variant="primary-outline"
                    onChange={(e) => setData("rating", e.target.value)}
                    placeholder="Enter the rating of the movie"
                    isError={errors.rating}
                />
                <div className="flex flex-row mt-4 items-center">
                    <InputLabel
                        forinput="is_featured"
                        value="Is Featured"
                        className="mr-3 mt-1"
                    />
                    <Checkbox
                        name="is_featured"
                        onChange={(e) =>
                            setData("is_featured", e.target.checked)
                        }
                        checked={movie.is_featured}
                    />
                </div>
                <PrimaryButton
                    type="submit"
                    className="mt-4"
                    processing={processing}
                >
                    Save
                </PrimaryButton>
            </form>
        </Authenticated>
    );
}
