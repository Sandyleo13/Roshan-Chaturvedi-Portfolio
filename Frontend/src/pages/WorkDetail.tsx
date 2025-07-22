import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Globe } from "lucide-react";

interface WorkItem {
  id: number;
  title: string;
  description: string;
  image: string | null;
  link: string | null;
  role: string | null;
  period: string | null;
  status: string | null;
  metrics: Record<string, string> | null;
  technologies: string[] | null;
  features: string[] | null;
  links: {
    website?: string;
    case_study?: string;
    contact?: string;
  } | null;
}

const WorkDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const [work, setWork] = useState<WorkItem | null>(null);

  useEffect(() => {
    fetch(`http://127.0.0.1:8000/api/works/${slug}`)
      .then((res) => res.json())
      .then((data) => {
        console.log("Work Detail:", data);
        setWork(data);
      })
      .catch((err) => console.error("API error:", err));
  }, [slug]);

  if (!work) {
    return (
      <div className="flex justify-center items-center h-screen text-gray-500">
        Loading...
      </div>
    );
  }

  return (
    <div className="container mx-auto py-16 px-4">
      <Card className="shadow-card">
        {work.image && (
          <img
            src={work.image}
            alt={work.title}
            className="w-full h-96 object-cover rounded-t"
          />
        )}
        <CardHeader>
          <CardTitle className="text-3xl font-bold">{work.title}</CardTitle>
          {work.status && (
            <Badge
              variant={work.status === "Active" ? "secondary" : "outline"}
              className="ml-2"
            >
              {work.status}
            </Badge>
          )}
          {work.period && (
            <span className="text-sm text-muted-foreground ml-4">
              {work.period}
            </span>
          )}
        </CardHeader>
        <CardContent>
          {work.role && (
            <p className="text-secondary text-lg font-medium mb-4">
              {work.role}
            </p>
          )}
          <p className="text-muted-foreground mb-6">{work.description}</p>

          {Array.isArray(work.technologies) && work.technologies.length > 0 && (
            <div className="mb-6">
              <h4 className="font-semibold mb-2">Technologies</h4>
              <div className="flex flex-wrap gap-2">
                {work.technologies.map((tech) => (
                  <Badge key={tech} variant="outline" className="text-xs">
                    {tech}
                  </Badge>
                ))}
              </div>
            </div>
          )}

          {Array.isArray(work.features) && work.features.length > 0 && (
            <div className="mb-6">
              <h4 className="font-semibold mb-2">Key Features</h4>
              <ul className="space-y-2">
                {work.features.map((feature, idx) => (
                  <li key={idx} className="text-sm text-muted-foreground">
                    • {feature}
                  </li>
                ))}
              </ul>
            </div>
          )}

          {work.metrics && typeof work.metrics === "object" && (
            <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
              {Object.entries(work.metrics).map(([key, value]) => (
                <div key={key} className="text-center">
                  <div className="font-bold text-lg">{value}</div>
                  <div className="text-xs text-muted-foreground capitalize">
                    {key.replace("_", " ")}
                  </div>
                </div>
              ))}
            </div>
          )}

          {work.links?.website && (
            <Button asChild className="hover-lift">
              <a
                href={work.links.website}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center gap-2"
              >
                <Globe className="w-4 h-4" />
                Visit Site
              </a>
            </Button>
          )}
        </CardContent>
      </Card>
    </div>
  );
};

export default WorkDetail;
